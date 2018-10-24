<?php

namespace WebentwicklerAt\NewsCalImporter\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Generic\Qom\ConstraintInterface;
use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

abstract class AbstractCalRepository extends Repository
{
    /**
     * @var array
     */
    protected $defaultOrderings = [
        'sysLanguageUid' => QueryInterface::ORDER_ASCENDING,
    ];

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\Generic\Mapper\DataMapper
     * @inject
     */
    protected $dataMapper;

    /**
     * @return array
     */
    abstract protected function getEnableFieldToBeIgnored();

    /**
     * @return void
     */
    public function initializeObject()
    {
        /** @var Typo3QuerySettings $defaultQuerySettings */
        $defaultQuerySettings = $this->objectManager->get(Typo3QuerySettings::class);
        $defaultQuerySettings->setRespectStoragePage(false);
        $defaultQuerySettings->setRespectSysLanguage(false);
        $defaultQuerySettings->setIncludeDeleted(false);
        $enableFieldsToBeIgnored = $this->getEnableFieldToBeIgnored();
        if (count($enableFieldsToBeIgnored)) {
            $defaultQuerySettings->setIgnoreEnableFields(true);
            $defaultQuerySettings->setEnableFieldsToBeIgnored($enableFieldsToBeIgnored);
        }
        $this->setDefaultQuerySettings($defaultQuerySettings);
        // unset language configuration to achieve proper handling in extbase
        unset($GLOBALS['TCA'][static::TABLE_NAME]['ctrl']['transOrigPointerField']);
        unset($GLOBALS['TCA'][static::TABLE_NAME]['ctrl']['languageField']);
    }

    /**
     * @return int
     */
    public function countToImport()
    {
        $query = $this->createQuery();
        $constraints = $this->getConstraints($query);
        if ($constraints instanceof ConstraintInterface) {
            $query->matching($constraints);
        }
        return $query->execute()->count();
    }

    /**
     * @param int $offset
     * @param int $limit
     * @return array|\TYPO3\CMS\Extbase\Persistence\QueryResultInterface
     */
    public function findToImport($offset = null, $limit = null)
    {
        $query = $this->createQuery();
        if ($offset !== null) {
            $query->setOffset((int)$offset);
        }
        if ($limit !== null) {
            $query->setLimit((int)$limit);
        }
        $constraints = $this->getConstraints($query);
        if ($constraints instanceof ConstraintInterface) {
            $query->matching($constraints);
        }
        return $query->execute();
    }

    /**
     * @param QueryInterface $query
     * @return ConstraintInterface|null
     */
    protected function getConstraints(&$query)
    {
        return null;
    }
}