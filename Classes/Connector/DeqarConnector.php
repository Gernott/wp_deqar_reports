<?php

namespace WEBprofil\WpDeqarReports\Connector;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\SingletonInterface;
use WEBprofil\WpDeqarReports\Domain\Model\Program;
use WEBprofil\WpDeqarReports\Domain\Model\Report;

class DeqarConnector implements SingletonInterface
{
    /**
     * @var string
     */
    private $authkey;

    public function __construct()
    {
        $settings = $this->getSettings();
        $this->url = $settings['report_submission_endpoint'];
        $this->authkey = $settings['authorization_token'];
    }

    /**
     * @var string
     */
    private $url;

    /**
     * @param $path
     * @return mixed
     */
    public function request($path, array $data = [], string $method = 'GET'): mixed
    {
        $curl = curl_init();
        $url = $this->url . $path;
        $headers = [
            "Authorization: Bearer " . $this->authkey
        ];
        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');

                if ($data) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
                }
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data) {
                    $url = sprintf("%s?%s", $url, http_build_query($data));
                }
        }

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
        $resultData = [];
        if ($result) {
            $resultData = json_decode($result, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                echo $result;
                exit;
            }
        }

        curl_close($curl);
        return $resultData;
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

    public function getInstitutions($query = null)
    {
        return $this->request('/webapi/v2/browse/institutions/', ['limit' => 3000, 'query' => $query]);
    }

    public function getReports(array $typo3Reports, $year = null): array
    {

        $settings = $this->getSettings();
        $reports = $typo3Reports;

        $data = [];
        $data['limit'] = 3000;
        if ($year) {
            $data['year'] = $year;
        }
        if ($settings['agency']) {
            $data['agency'] = $settings['agency'];
        }

        $response = $this->request('/webapi/v2/browse/reports/', $data);
        $deqarReports = $response['results'];

        foreach ($deqarReports as $deqarData) {
            /** @var Report $typo3Report */
            $typo3ReportFound = false;
            foreach ($typo3Reports as $typo3Report) {
                if ($typo3Report->getReportId() === $deqarData['id']) {
                    $typo3Report->setDeqarData($deqarData);
                    $typo3ReportFound = true;
                }
            }
            if (!$typo3ReportFound) {
                $deqarReport = new Report();
                $deqarReport->setDeqarData($deqarData);

                $types = [
                    'institutional' => 1,
                    'programme' => 2,
                    'joint programme' => 3
                ];

                $deqarReport->setType($types[$deqarData['agency_esg_activity_type']]);
                $deqarReport->setReportId($deqarData['id']);

                $reports[] = $deqarReport;
            }
        }
        return $reports;

    }

    public function uploadReport(Report $report)
    {
        $settings = $this->getSettings();
        $data = [
            'agency' => $report->getAgency(),
            'status' => $report->getStatus(),
            'date_format' => $settings['date_format'],
            'report_files' => [
                0 => [
                    'original_location' => $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'] . '/' . $report->getFileOriginalLocation()->getOriginalResource()->getPublicUrl(),
                    'display_name' => $report->getFileDisplayName(),
                    'report_language' => [0 => $report->getFileReportLanguage()]
                ],
            ],
        ];

        foreach (explode(',', (string) $report->getInstitutionDeqarId()) as $deqarId) {
            $data['institutions'][] = [
                'deqar_id' => $deqarId
            ];
        }
//        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($_SERVER);
//        exit;
        if ($settings['submit']['local_identifier']) {
//            $data['local_identifier'] = $report->getUid();
        }
        if ($settings['submit']['activity_local_identifier']) {
            $data['activity_local_identifier'] = $report->getActivityLocalIdentifier();
        }
        if ($settings['submit']['activity'] && $report->getActivity()) {
            $data['activity'] = $report->getActivity()->getIdentifier();
        }
        if ($report->getDecision()) {
            $data['decision'] = $report->getDecision()->getDequarDecision();
        }
        if ($report->getValidFrom()) {
            $data['valid_from'] = $report->getValidFrom()->format('Y-m-d');
        }
        if ($settings['submit']['valid_to'] && $report->getValidTo()) {
            $data['valid_to'] = $report->getValidTo()->format('Y-m-d');
        }
        /** @var Program $program */
        foreach ($report->getPrograms() as $program) {
            $programArray = [
                'name_primary' => $program->getProgrammeNamePrimary()
            ];

            if ($settings['submit']['programme_identifier']) {
                $programArray['identifiers']['identifier'] = $program->getProgrammeIdentifier();
            }
            if ($settings['submit']['programme_qualification_primary']) {
                $programArray['qualification_primary'] = $program->getProgrammeQualificationPrimary();
            }
            if ($settings['submit']['programme_nqf_level']) {
                $programArray['nqf_level'] = $program->getProgrammeNqfLevel();
            }
            if ($settings['submit']['qf_ehea_level']) {
                $programArray['nqf_level'] = $program->getProgrammeGfEheaLevel();
            }

            $data['programs'][] = $programArray;
        }
        echo(json_encode($data, JSON_PRETTY_PRINT));
        return $this->request('/submissionapi/v1/submit/report', $data, 'POST');
    }

    public function institutionItems(&$config): void
    {
        $institutions = $this->getInstitutions();
        foreach ($institutions['results'] as $institution) {
            $config['items'][] = [
                $institution['name_primary'] . ' (' . $institution['deqar_id'] . ')',
                $institution['deqar_id']
            ];
        }
    }
}


