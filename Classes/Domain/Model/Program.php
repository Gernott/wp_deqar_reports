<?php
namespace WEBprofil\WpDeqarReports\Domain\Model;

use TYPO3\CMS\Extbase\Annotation as Extbase;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
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
 * Program
 */
class Program extends AbstractEntity
{
    /**
     * Local Identifiers
     *
     * @var int
     */
    protected $programmeIdentifier = 0;

    /**
     * programmeNamePrimary
     *
     * @var string
     * @Extbase\Validate("NotEmpty")
     */
    protected $programmeNamePrimary = '';

    /**
     * programmeQualificationPrimary
     *
     * @var string
     */
    protected $programmeQualificationPrimary = '';

    /**
     * programmeNqfLevel
     *
     * @var string
     */
    protected $programmeNqfLevel = '';

    /**
     * programmeGfEheaLevel
     *
     * @var int
     */
    protected $programmeGfEheaLevel = 0;

    /**
     * Returns the programmeIdentifier
     *
     * @return int $programmeIdentifier
     */
    public function getProgrammeIdentifier()
    {
        return $this->programmeIdentifier;
    }

    /**
     * Sets the programmeIdentifier
     *
     * @param int $programmeIdentifier
     * @return void
     */
    public function setProgrammeIdentifier($programmeIdentifier)
    {
        $this->programmeIdentifier = $programmeIdentifier;
    }

    /**
     * Returns the programmeNamePrimary
     *
     * @return string $programmeNamePrimary
     */
    public function getProgrammeNamePrimary()
    {
        return $this->programmeNamePrimary;
    }

    /**
     * Sets the programmeNamePrimary
     *
     * @param string $programmeNamePrimary
     * @return void
     */
    public function setProgrammeNamePrimary($programmeNamePrimary)
    {
        $this->programmeNamePrimary = $programmeNamePrimary;
    }

    /**
     * Returns the programmeQualificationPrimary
     *
     * @return string $programmeQualificationPrimary
     */
    public function getProgrammeQualificationPrimary()
    {
        return $this->programmeQualificationPrimary;
    }

    /**
     * Sets the programmeQualificationPrimary
     *
     * @param string $programmeQualificationPrimary
     * @return void
     */
    public function setProgrammeQualificationPrimary($programmeQualificationPrimary)
    {
        $this->programmeQualificationPrimary = $programmeQualificationPrimary;
    }

    /**
     * Returns the programmeNqfLevel
     *
     * @return string $programmeNqfLevel
     */
    public function getProgrammeNqfLevel()
    {
        return $this->programmeNqfLevel;
    }

    /**
     * Sets the programmeNqfLevel
     *
     * @param string $programmeNqfLevel
     * @return void
     */
    public function setProgrammeNqfLevel($programmeNqfLevel)
    {
        $this->programmeNqfLevel = $programmeNqfLevel;
    }

    /**
     * Returns the programmeGfEheaLevel
     *
     * @return int $programmeGfEheaLevel
     */
    public function getProgrammeGfEheaLevel()
    {
        return $this->programmeGfEheaLevel;
    }

    /**
     * Sets the programmeGfEheaLevel
     *
     * @param int $programmeGfEheaLevel
     * @return void
     */
    public function setProgrammeGfEheaLevel($programmeGfEheaLevel)
    {
        $this->programmeGfEheaLevel = $programmeGfEheaLevel;
    }
}
