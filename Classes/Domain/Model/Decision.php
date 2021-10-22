<?php
namespace WEBprofil\WpDeqarReports\Domain\Model;

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
 * Decision
 */
class Decision extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * Internal name
     *
     * @var string
     * @validate NotEmpty
     */
    protected $title = '';

    /**
     * ID of the DEQAR decision
     *
     * @var int
     */
    protected $dequarDecision = 0;

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
     * Returns the dequarDecision
     *
     * @return int $dequarDecision
     */
    public function getDequarDecision()
    {
        return $this->dequarDecision;
    }

    /**
     * Sets the dequarDecision
     *
     * @param int $dequarDecision
     * @return void
     */
    public function setDequarDecision($dequarDecision)
    {
        $this->dequarDecision = $dequarDecision;
    }
}
