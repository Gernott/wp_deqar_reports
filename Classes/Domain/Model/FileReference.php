<?php

namespace WEBprofil\WpDeqarReports\Domain\Model;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Resource\ResourceFactory;

class FileReference extends \TYPO3\CMS\Extbase\Domain\Model\FileReference
{

    /**
     * Uid of the referenced sys_file. Needed for extbase to serialize the
     * reference correctly.
     */
    protected ?int $uidLocal = null;

    protected ?\TYPO3\CMS\Core\Resource\FileReference $originalResource = null;

    public function setOriginalResource(\TYPO3\CMS\Core\Resource\FileReference $originalResource): void
    {
        $this->originalResource = $originalResource;
        $this->uidLocal = $originalResource->getOriginalFile()->getUid();
    }

    public function getOriginalResource(): \TYPO3\CMS\Core\Resource\FileReference
    {
        if ($this->originalResource === null) {
            $uid = $this->_localizedUid;
            $this->originalResource = GeneralUtility::makeInstance(ResourceFactory::class)->getFileReferenceObject($uid);
        }

        return $this->originalResource;
    }
}
