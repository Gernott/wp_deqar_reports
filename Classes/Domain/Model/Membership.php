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
 * Membership
 */
class Membership extends AbstractEntity
{
    /**
     * Name as shown on the website
     *
     * @var string
     * @Extbase\Validate("NotEmpty")
     */
    protected $title = '';

    /**
     * One or more institutions (Official Institution Name) via API
     *
     * @var int
     * @Extbase\Validate("NotEmpty")
     */
    protected $institutions = 0;

    /**
     * Returns the title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Returns the institutions
     *
     * @return int $institutions
     */
    public function getInstitutions()
    {
        return $this->institutions;
    }

    /**
     * Sets the institutions
     *
     * @param int $institutions
     * @return void
     */
    public function setInstitutions($institutions)
    {
        $this->institutions = $institutions;
    }
}
