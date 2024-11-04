<?php

namespace WEBprofil\WpDeqarReports\Domain\Model;

use TYPO3\CMS\Core\Resource\ResourceInterface;
use TYPO3\CMS\Core\Resource\Exception\ResourceDoesNotExistException;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Resource\ResourceFactory;
use TYPO3\CMS\Extbase\Domain\Model\AbstractFileFolder;

class FileReference extends AbstractFileFolder
{

    /**
     * Uid of the referenced sys_file. Needed for extbase to serialize the
     * reference correctly.
     *
     * @var int
     */
    protected $uidLocal;

    /**
     * @param ResourceInterface $originalResource
     */
    public function setOriginalResource(ResourceInterface $originalResource): void
    {
        $this->originalResource = $originalResource;
        $this->uidLocal = (int)$originalResource->getUid();
    }

    /**
     * @return \TYPO3\CMS\Core\Resource\FileReference
     * @throws ResourceDoesNotExistException
     */
    public function getOriginalResource()
    {
        if ($this->originalResource === null) {
            $this->originalResource = GeneralUtility::makeInstance(ResourceFactory::class)->getFileReferenceObject($this->getUid());
        }

        return $this->originalResource;
    }
}
