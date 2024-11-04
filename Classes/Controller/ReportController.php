<?php
namespace WEBprofil\WpDeqarReports\Controller;

use TYPO3\CMS\Core\Type\ContextualFeedbackSeverity;
use TYPO3\CMS\Extbase\Annotation as Extbase;
use WEBprofil\WpDeqarReports\Domain\Repository\ActivityRepository;
use WEBprofil\WpDeqarReports\Domain\Repository\DecisionRepository;
use WEBprofil\WpDeqarReports\Connector\DeqarConnector;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Resource\Exception\ExistingTargetFileNameException;
use TYPO3\CMS\Core\Resource\Exception\InsufficientFolderAccessPermissionsException;
use RuntimeException;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException;
use TYPO3\CMS\Extbase\Persistence\Exception\UnknownObjectException;
use WEBprofil\WpDeqarReports\Domain\Model\FileReference;
use WEBprofil\WpDeqarReports\Domain\Model\Program;
use WEBprofil\WpDeqarReports\Domain\Model\Report;
use WEBprofil\WpDeqarReports\Domain\Repository\ReportRepository;
use TYPO3\CMS\Core\Resource\StorageRepository;

/***
 *
 * This file is part of the "DEQAR Report upload" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2021 WEBprofil <office@webprofil.at>, WEBprofil
 *
 ***/

/**
 * ReportController
 */
class ReportController extends ActionController
{
    public function __construct(
        protected ReportRepository $reportRepository,
        protected ActivityRepository $activityRepository,
        protected DecisionRepository $decisionRepository,
        protected DeqarConnector $decarConnector)
    {
    }

    /**
     * action list
     *
     * @return void
     */
    public function listAction(): ResponseInterface
    {
        $arguments = $this->request->getArguments();

        $typo3Reports = $this->reportRepository->findAll()->toArray();

        $reports = $this->decarConnector->getReports($typo3Reports, $arguments['year']);
        $years = $this->getYearsToFilter($typo3Reports);

        $this->view->assign('years', $years);
        $this->view->assign('year', $arguments['year']);
        $this->view->assign('reports', $reports);
        $this->view->assign('settings', $this->getSettings());

        return $this->htmlResponse();
    }

    /**
     * action show
     *
     * @return void
     */
    public function showAction(Report $report): ResponseInterface
    {
        $this->view->assign('report', $report);
        $this->view->assign('settings', GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('wp_deqar_reports'));
        return $this->htmlResponse();
    }

    /**
     * action getInstitutions
     *
     * @return false|string|void
     */
    public function getInstitutionsAction(): ResponseInterface
    {
        $select2Results = [];
        $institutions = $this->decarConnector->getInstitutions($_REQUEST['search']);
        foreach ($institutions['results'] as $result) {
            $select2Result['id'] = $result['deqar_id'];
            $select2Result['text'] = $result['name_primary'] . ' (' . $result['deqar_id'] . ')';
            $select2Results['results'][] = $select2Result;
        }
        return $this->jsonResponse(json_encode($select2Results, JSON_THROW_ON_ERROR));
    }

    /**
     * action new
     *
     * @return void
     */
    public function newAction(): ResponseInterface
    {
        $activities = $this->activityRepository->findAll();
        $decisions = $this->decisionRepository->findAll();
        $languages = $this->getLanguages();

        $this->view->assign('settings', $this->getSettings());
        $this->view->assign('activities', $activities);
        $this->view->assign('decisions', $decisions);
        $this->view->assign('languages', $languages);
        return $this->htmlResponse();
    }

    /**
     * action create
     *
     * @return ResponseInterface
     * @throws IllegalObjectTypeException
     * @throws ExistingTargetFileNameException
     */
    public function createAction(Report $newReport): ResponseInterface
    {
        $arguments = $this->request->getArguments();
        $settings = $this->getSettings();

        // upload original file
        if ($arguments['fileOriginalLocation']['tmp_name'] !== '') {
            $fileReference = $this->uploadFalFile(
                $arguments['fileOriginalLocation'],
                $settings['upload_path']
            );
            $newReport->setFileOriginalLocation($fileReference);
        }

        // upload ser report file
        if ($arguments['serReportFile']['tmp_name'] !== '') {
            $fileReference = $this->uploadFalFile(
                $arguments['serReportFile'],
                $settings['upload_path']
            );
            $newReport->setSerReportFile($fileReference);
        }

        // set pid from settings
        $newReport->setPid($settings['pid']);
        // and imploded institutionDeqarIds
        $newReport->setInstitutionDeqarId(implode(',', $arguments['institutionDeqarId']));

        // add all the programs as inline
        foreach ($arguments['programs']['programmeIdentifier'] as $key => $programmeIdentifier) {
            $program = GeneralUtility::makeInstance(Program::class);
            $program->setProgrammeIdentifier($programmeIdentifier);
            $program->setProgrammeQualificationPrimary($arguments['programs']['programmeQualificationPrimary'][$key]);
            $program->setProgrammeNamePrimary($arguments['programs']['programmeNamePrimary'][$key]);
            $program->setProgrammeNqfLevel($arguments['programs']['programmeNqfLevel'][$key]);
            $program->setProgrammeGfEheaLevel($arguments['programs']['programmeGfEheaLevel'][$key]);
            $newReport->addProgram($program);
        }

        // and set prefill values for fields that weren't shown
        $newReport = $this->addPrefills($newReport);

        // send to deqar
        if ($arguments['transferToDeqar']) {
            $response = $this->decarConnector->uploadReport($newReport);
        }
//        var_dump($response);
//        exit;


        // show errors if deqar returns any
        if ($arguments['transferToDeqar'] && $response['submission_status'] === 'errors') {
            foreach ($response['errors'] as $errorGroupKey => $errorGroup) {
                foreach ($errorGroup as $error) {
                    if (is_array($error)) {
                        foreach ($error as $subErrorKey => $subError) {
                            $this->addFlashMessage(
                                ucfirst((string) $errorGroupKey) . ' / ' . ucfirst($subErrorKey) . ': ' . implode("\n",
                                    $subError),
                                '',
                                ContextualFeedbackSeverity::ERROR);
                        }
                    } else {
                        $this->addFlashMessage(
                            ucfirst((string) $errorGroupKey) . ': ' . ucfirst((string) $error),
                            '',
                            ContextualFeedbackSeverity::ERROR
                        );
                    }
                }
            }
            // return to create page
            return $this->forwardToReferringRequest();
        }

        // if there weren't any errors, save report to typo3
        $this->reportRepository->add($newReport);
        $this->addFlashMessage('Report was created!');
        return $this->redirect('list');
    }

    /**
     * action edit
     *
     * @return void
     */
    #[Extbase\IgnoreValidation(['argumentName' => 'report'])]
    public function editAction(Report $report): ResponseInterface
    {
        $activities = $this->activityRepository->findAll();
        $decisions = $this->decisionRepository->findAll();
        $languages = $this->getLanguages();

        $this->view->assign('settings', $this->getSettings());
        $this->view->assign('activities', $activities);
        $this->view->assign('decisions', $decisions);
        $this->view->assign('languages', $languages);
        $this->view->assign('report', $report);
        $this->view->assign('edit', true);
        return $this->htmlResponse();
    }

    /**
     * action update
     *
     * @return ResponseInterface
     * @throws IllegalObjectTypeException
     * @throws UnknownObjectException
     */
    public function updateAction(Report $report): ResponseInterface
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html',
            '', ContextualFeedbackSeverity::WARNING);
        $this->reportRepository->update($report);
        return $this->redirect('list');
    }

    /**
     * action delete
     *
     * @return ResponseInterface
     * @throws IllegalObjectTypeException
     */
    public function deleteAction(Report $report): ResponseInterface
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html',
            '', ContextualFeedbackSeverity::WARNING);
        $this->reportRepository->remove($report);
        return $this->redirect('list');
    }

    private function getSettings(): array
    {
        $cleanSettings = [];
        $settings = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('wp_deqar_reports');
        foreach ($settings as $key => $setting) {
            $key = str_replace('.', '', (string) $key);
            $cleanSettings[$key] = $setting;
        }
        return $cleanSettings;
    }

    /**
     * Moves a file to a folder and returns the file reference
     *
     * @param $fileData
     * @param $folder
     * @throws ExistingTargetFileNameException
     * @throws InsufficientFolderAccessPermissionsException
     */
    private function uploadFalFile($fileData, $folder): FileReference
    {
        $uploadDir = GeneralUtility::getFileAbsFileName('fileadmin/' . ltrim((string) $folder, '/'));
        if (!is_dir($uploadDir) && !mkdir($uploadDir, 0777, true) && !is_dir($uploadDir)) {
            throw new RuntimeException(sprintf('Directory "%s" was not created', $uploadDir), 6_838_054_980);
        }

        $storageRepository = GeneralUtility::makeInstance(StorageRepository::class);
        $newFileReference = GeneralUtility::makeInstance(FileReference::class);
        if (!empty($fileData['name'])) {
            $storage = $storageRepository->findByUid(1); #Fileadmin = 1
            $saveFolder = $storage->getFolder($folder);

            $fileObject = $storage->addFile($fileData['tmp_name'], $saveFolder, $fileData['name']);
            //$fileName = $fileObject->getName();
            $newFileReference->setOriginalResource($fileObject);
        }
        return $newFileReference;
    }

    private function getLanguages(): array
    {
        $languageKeys = [];
        $settings = $this->getSettings();
        $languages = array_map('trim', explode(',', (string) $settings['report_languages']));
        foreach ($languages as $language) {
            $languageKeys[$language] = $language;
        }
        return $languageKeys;
    }

    private function getYearsToFilter(array $reports): array
    {
        $years = [];
        /** @var Report $report */
        foreach ($reports as $report) {
            if ($report->getValidTo()) {
                $years[$report->getValidTo()->format('Y')] = $report->getValidTo()->format('Y');
            }
            if ($report->getValidFrom()) {
                $years[$report->getValidFrom()->format('Y')] = $report->getValidFrom()->format('Y');
            }
        }
        return $years;
    }

    /**
     * @return Report
     */
    private function addPrefills(Report $report): Report
    {
        $settings = $this->getSettings();

        foreach ($settings['prefill'] as $key => $value) {
            if (!(bool)$settings['show'][$key]) {
                switch ($key) {
                    case 'type':
                        $report->setType($value);
                        break;
                    case 'agency':
                        $report->setAgency($value);
                        break;
                    case 'activity':
                        $activity = $this->activityRepository->findByUid((int)$value);
                        if ($activity) {
                            $report->setActivity($activity);
                        }
                        break;
                    case 'activity_local_identifier':
                        $report->setActivityLocalIdentifier($value);
                        break;
                    case 'status':
                        $report->setStatus($value);
                        break;
                    case 'file_report_language':
                        $report->setFileReportLanguage($value);
                        break;
                    case 'institution_deqar_id':
                        $report->setInstitutionDeqarId($value);
                        break;
                    case 'programme_name_primary':
                        /** @var Program $program */
                        foreach ($report->getPrograms() as $program) {
                            $program->setProgrammeNamePrimary($value);
                        }
                        break;
                    case 'programme_identifier':
                        /** @var Program $program */
                        foreach ($report->getPrograms() as $program) {
                            $program->setProgrammeIdentifier($value);
                        }
                        break;
                    case 'programme_qualification_primary':
                        /** @var Program $program */
                        foreach ($report->getPrograms() as $program) {
                            $program->setProgrammeQualificationPrimary($value);
                        }
                        break;
                    case 'programme_nqf_level':
                        /** @var Program $program */
                        foreach ($report->getPrograms() as $program) {
                            $program->setProgrammeNqfLevel($value);
                        }
                        break;
                    case 'programme_qf_ehea_level':
                        /** @var Program $program */
                        foreach ($report->getPrograms() as $program) {
                            $program->setProgrammeGfEheaLevel($value);
                        }
                        break;
                }
            }
        }
        return $report;
    }

    /**
     * action plugin
     *
     * @return void
     */
    public function pluginAction(): ResponseInterface
    {
        $arguments = $this->request->getArguments();
        $typo3Reports = $this->reportRepository->findAll()->toArray();
        $reports = $this->decarConnector->getReports($typo3Reports);
        $decisions = $this->decisionRepository->findAll();
        $institutionReports = [];
        $sortedDecisions = [];
        foreach ($decisions as $decision) {
            $sortedDecisions[$decision->getUid()] = $decision;
        }

        foreach ($reports as $report) {

            // deqar reports
            if (!$report->getUid()) {
                $deqarDatat = $report->getDeqarData();
                if ($deqarDatat['decision'] !== 'negative') {
                    $report->setDecision($sortedDecisions[6]);
                } else {
                    if ($deqarDatat['decision'] === 'positive with conditions or restrictions') {
                        $report->setDecision($sortedDecisions[3]);
                    } else {
                        $report->setDecision($sortedDecisions[1]);
                    }
                }
                foreach ($deqarDatat['institutions'] as $institution) {
                    $institutionReports[$report->getDecision()->getUid()]['institutions'][$institution['deqar_id']]['institution'] = $institution['name_primary'];
                    if ($report->isValid()) {
                        $institutionReports[$report->getDecision()->getUid()]['institutions'][$institution['deqar_id']]['reports'][] = $report;
                        $institutionReports[$report->getDecision()->getUid()]['decision'] = $report->getDecision();
                    } else {
                        $institutionReports[$report->getDecision()->getUid()]['institutions'][$institution['deqar_id']]['invalid_reports'][] = $report;
                    }
                }
            } else {
                $institutionReports[$report->getDecision()->getUid()]['institutions'][$report->getInstitutionDeqarId()]['institution'] = $report->getInstitutionName();
                if ($report->isValid()) {
                    $institutionReports[$report->getDecision()->getUid()]['institutions'][$report->getInstitutionDeqarId()]['reports'][] = $report;
                } else {
                    $institutionReports[$report->getDecision()->getUid()]['institutions'][$institution['deqar_id']]['invalid_reports'][] = $report;
                }
                $institutionReports[$report->getDecision()->getUid()]['decision'] = $report->getDecision();
            }
        }

        $this->view->assign('arguments', $arguments);
        $this->view->assign('reports', $reports);
        $this->view->assign('institutionReports', $institutionReports);
        $this->view->assign('settings', $this->getSettings());
        return $this->htmlResponse();
    }
}
