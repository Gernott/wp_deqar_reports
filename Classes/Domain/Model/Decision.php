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
 * Decision
 */
class Decision extends AbstractEntity
{
    /**
     * Internal name
     *
     * @var string
     */
    #[Extbase\Validate(['validator' => 'NotEmpty'])]
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
    public function setTitle($title): void
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
    public function setDequarDecision($dequarDecision): void
    {
        $this->dequarDecision = $dequarDecision;
    }
}
