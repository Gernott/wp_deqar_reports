<?php
namespace WEBprofil\WpDeqarReports\Domain\Model;

use TYPO3\CMS\Extbase\Annotation as Extbase;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;
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
 * Report
 */
class Report extends AbstractEntity
{
    /**
     * DEQAR uid. Return value after submit
     *
     * @var string
     */
    protected $reportId = '';

    /**
     * 1 = I
     * 2 = P
     * 3 = J
     *
     * @var int
     * @Extbase\Validate("NotEmpty")
     */
    protected $type = 0;

    /**
     * agency
     *
     * @var string
     */
    protected $agency = '';

    /**
     * Internal Id.
     * activity or activity_local_identifier is required
     *
     * @var string
     */
    protected $activityLocalIdentifier = '';

    /**
     * 1 = part of obligatory EQA system
     * 2 = voluntary
     *
     * @var int
     */
    protected $status = 0;

    /**
     * validFrom
     *
     * @var \DateTime
     */
    protected $validFrom = null;

    /**
     * validTo
     *
     * @var \DateTime
     */
    protected $validTo = null;

    /**
     * If in use, “hardcopy” is disabled.
     *
     * @var FileReference
     * @Extbase\ORM\Cascade("remove")
     */
    protected $serReportFile = null;

    /**
     * serReportName
     *
     * @var string
     */
    protected $serReportName = '';

    /**
     * Multiselect, 1:n relation, saved as comma list of IDs
     *
     *
     * @var string
     */
    protected $institutionDeqarId = '';

    /**
     * institutionName
     *
     * @var string
     */
    protected $institutionName = '';

    /**
     * If active, “ser_report_file” is disabled
     *
     * @var bool
     */
    protected $hardcopy = false;

    /**
     * Public path to the file
     *
     * @var FileReference
     * @Extbase\ORM\Cascade("remove")
     */
    protected $fileOriginalLocation = null;

    /**
     * fileDisplayName
     *
     * @var string
     */
    protected $fileDisplayName = '';

    /**
     * Languages from the extension setting report_languages
     *
     * @var string
     */
    protected $fileReportLanguage = '';

    /**
     * DEQUAR activity Id.activity_local_identifier is required
     * n:1 Relation to Activity
     *
     * @var Activity
     */
    protected $activity = null;

    /**
     * n:1 Relation to Decision
     *
     * @var Decision
     */
    protected $decision = null;

    /**
     * IRRE Relation, can be none, one or more.
     *
     * @var ObjectStorage<Program>
     * @Extbase\ORM\Cascade("remove")
     */
    protected $programs = null;

    /**
     * @var array
     */
    public $decarData;

    /**
     * Returns the reportId
     *
     * @return string $reportId
     */
    public function getReportId()
    {
        return $this->reportId;
    }

    /**
     * Sets the reportId
     *
     * @param string $reportId
     * @return void
     */
    public function setReportId($reportId)
    {
        $this->reportId = $reportId;
    }

    /**
     * Returns the type
     *
     * @return int $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets the type
     *
     * @param int $type
     * @return void
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Returns the agency
     *
     * @return string $agency
     */
    public function getAgency()
    {
        return $this->agency;
    }

    /**
     * Sets the agency
     *
     * @param string $agency
     * @return void
     */
    public function setAgency($agency)
    {
        $this->agency = $agency;
    }

    /**
     * Returns the activityLocalIdentifier
     *
     * @return string $activityLocalIdentifier
     */
    public function getActivityLocalIdentifier()
    {
        return $this->activityLocalIdentifier;
    }

    /**
     * Sets the activityLocalIdentifier
     *
     * @param string $activityLocalIdentifier
     * @return void
     */
    public function setActivityLocalIdentifier($activityLocalIdentifier)
    {
        $this->activityLocalIdentifier = $activityLocalIdentifier;
    }

    /**
     * Returns the status
     *
     * @return int $status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Sets the status
     *
     * @param int $status
     * @return void
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Returns the validFrom
     *
     * @return \DateTime $validFrom
     */
    public function getValidFrom()
    {
        return $this->validFrom;
    }

    /**
     * Sets the validFrom
     *
     * @param \DateTime $validFrom
     * @return void
     */
    public function setValidFrom(\DateTime $validFrom = null)
    {
        $this->validFrom = $validFrom;
    }

    /**
     * Returns the validTo
     *
     * @return \DateTime $validTo
     */
    public function getValidTo()
    {
        return $this->validTo;
    }

    /**
     * Sets the validTo
     *
     * @param \DateTime $validTo
     * @return void
     */
    public function setValidTo(\DateTime $validTo = null)
    {
        $this->validTo = $validTo;
    }

    /**
     * Returns the serReportFile
     *
     * @return FileReference $serReportFile
     */
    public function getSerReportFile()
    {
        return $this->serReportFile;
    }

    /**
     * Sets the serReportFile
     *
     * @param FileReference $serReportFile
     * @return void
     */
    public function setSerReportFile(FileReference $serReportFile = null)
    {
        $this->serReportFile = $serReportFile;
    }

    /**
     * Returns the serReportName
     *
     * @return string $serReportName
     */
    public function getSerReportName()
    {
        return $this->serReportName;
    }

    /**
     * Sets the serReportName
     *
     * @param string $serReportName
     * @return void
     */
    public function setSerReportName($serReportName)
    {
        $this->serReportName = $serReportName;
    }

    /**
     * Returns the institutionDeqarId
     *
     * @return string $institutionDeqarId
     */
    public function getInstitutionDeqarId()
    {
        return $this->institutionDeqarId;
    }

    /**
     * Sets the institutionDeqarId
     *
     * @param string $institutionDeqarId
     * @return void
     */
    public function setInstitutionDeqarId($institutionDeqarId)
    {
        $this->institutionDeqarId = $institutionDeqarId;
    }

    /**
     * Returns the institutionName
     *
     * @return string $institutionName
     */
    public function getInstitutionName()
    {
        return $this->institutionName;
    }

    /**
     * Sets the institutionName
     *
     * @param string $institutionName
     * @return void
     */
    public function setInstitutionName($institutionName)
    {
        $this->institutionName = $institutionName;
    }

    /**
     * Returns the hardcopy
     *
     * @return bool $hardcopy
     */
    public function getHardcopy()
    {
        return $this->hardcopy;
    }

    /**
     * Sets the hardcopy
     *
     * @param bool $hardcopy
     * @return void
     */
    public function setHardcopy($hardcopy)
    {
        $this->hardcopy = $hardcopy;
    }

    /**
     * Returns the boolean state of hardcopy
     *
     * @return bool
     */
    public function isHardcopy()
    {
        return $this->hardcopy;
    }

    /**
     * Returns the fileOriginalLocation
     *
     * @return FileReference $fileOriginalLocation
     */
    public function getFileOriginalLocation()
    {
        return $this->fileOriginalLocation;
    }

    /**
     * Sets the fileOriginalLocation
     *
     * @param FileReference $fileOriginalLocationF
     * @return void
     */
    public function setFileOriginalLocation(FileReference $fileOriginalLocation)
    {
        $this->fileOriginalLocation = $fileOriginalLocation;
    }

    /**
     * Returns the fileDisplayName
     *
     * @return string $fileDisplayName
     */
    public function getFileDisplayName()
    {
        return $this->fileDisplayName;
    }

    /**
     * Sets the fileDisplayName
     *
     * @param string $fileDisplayName
     * @return void
     */
    public function setFileDisplayName($fileDisplayName)
    {
        $this->fileDisplayName = $fileDisplayName;
    }

    /**
     * Returns the fileReportLanguage
     *
     * @return string $fileReportLanguage
     */
    public function getFileReportLanguage()
    {
        return $this->fileReportLanguage;
    }

    /**
     * Sets the fileReportLanguage
     *
     * @param string $fileReportLanguage
     * @return void
     */
    public function setFileReportLanguage($fileReportLanguage)
    {
        $this->fileReportLanguage = $fileReportLanguage;
    }

    /**
     * __construct
     */
    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->programs = new ObjectStorage();
    }

    /**
     * Returns the activity
     *
     * @return Activity $activity
     */
    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * Sets the activity
     *
     * @param Activity $activity
     * @return void
     */
    public function setActivity(Activity $activity)
    {
        $this->activity = $activity;
    }

    /**
     * Returns the decision
     *
     * @return Decision $decision
     */
    public function getDecision()
    {
        return $this->decision;
    }

    /**
     * Sets the decision
     *
     * @param Decision $decision
     * @return void
     */
    public function setDecision(Decision $decision)
    {
        $this->decision = $decision;
    }

    /**
     * Adds a Program
     *
     * @param Program $program
     * @return void
     */
    public function addProgram(Program $program)
    {
        $this->programs->attach($program);
    }

    /**
     * Removes a Program
     *
     * @param Program $programToRemove The Program to be removed
     * @return void
     */
    public function removeProgram(Program $programToRemove)
    {
        $this->programs->detach($programToRemove);
    }

    /**
     * Returns the programs
     *
     * @return ObjectStorage<Program> $programs
     */
    public function getPrograms()
    {
        return $this->programs;
    }

    /**
     * Sets the programs
     *
     * @param ObjectStorage<Program> $programs
     * @return void
     */
    public function setPrograms(ObjectStorage $programs)
    {
        $this->programs = $programs;
    }

    public function getDeqarData(): array
    {
        return $this->decarData;
    }

    public function setDeqarData($deqarReport): void
    {
        $this->decarData = $deqarReport;
    }

    public function isValid()
    {
        if ($this->decarData) {
            $this->validTo = new \DateTime($this->decarData['valid_to']);
        }
        return !$this->validTo || $this->validTo->getTimestamp() > time();
    }
}
