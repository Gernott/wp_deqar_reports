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
 * Activity
 */
class Activity extends AbstractEntity
{
    /**
     * Identifier from DEQAR
     *
     * @var int
     * @Extbase\Validate("NotEmpty")
     */
    protected $identifier = 0;

    /**
     * Name as shown on the website
     *
     * @var string
     * @Extbase\Validate("NotEmpty")
     */
    protected $title = '';

    /**
     * Returns the identifier
     *
     * @return int $identifier
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Sets the identifier
     *
     * @param int $identifier
     * @return void
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
    }

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
}
