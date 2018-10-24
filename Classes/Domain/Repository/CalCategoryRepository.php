<?php

namespace WebentwicklerAt\NewsCalImporter\Domain\Repository;

class CalCategoryRepository extends AbstractCalRepository
{
    const TABLE_NAME = 'tx_cal_category';

    /**
     * @return array
     */
    protected function getEnableFieldToBeIgnored()
    {
        return array_values($GLOBALS['TCA'][static::TABLE_NAME]['ctrl']['enablecolumns']);
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\QueryInterface $query
     * @return null|\TYPO3\CMS\Extbase\Persistence\Generic\Qom\ConstraintInterface
     */
    protected function getConstraints(&$query)
    {
        return $query->logicalAnd([
            $query->equals('deleted', false),
            $query->equals('t3ver_oid', 0),
            $query->equals('t3ver_wsid', 0),
        ]);
    }
}