<?php

namespace WebentwicklerAt\NewsCalImporter\Service\Import\DataProvider;

use WebentwicklerAt\NewsCalImporter\Domain\Model\CalCategory;

class CalCategoryImportDataProviderService extends AbstractImportDataProviderService
{
    const IMPORT_TABLE = 'tx_cal_category';

    /**
     * @var \WebentwicklerAt\NewsCalImporter\Domain\Repository\CalCategoryRepository
     */
    protected $calCategoryRepository;

    /**
     * @param \WebentwicklerAt\NewsCalImporter\Domain\Repository\CalCategoryRepository $calCategoryRepository
     */
    public function injectCalCategoryRepository(\WebentwicklerAt\NewsCalImporter\Domain\Repository\CalCategoryRepository $calCategoryRepository)
    {
        $this->calCategoryRepository = $calCategoryRepository;
    }

    /**
     * @return int
     */
    public function getTotalRecordCount()
    {
        return $this->calCategoryRepository->countToImport();
    }

    /**
     * @param int $offset
     * @param int $numberOfRecordsPerRun
     * @return array
     */
    public function getImportData($offset, $numberOfRecordsPerRun)
    {
        $importData = [];
        $calCategories = $this->calCategoryRepository->findToImport($offset, $numberOfRecordsPerRun);
        /** @var CalCategory $calCategory */
        foreach ($calCategories as $calCategory) {
            $importDataItem = [
                // EXT:core
                'pid' => $calCategory->getPid(),
                'tstamp' => is_object($calCategory->getTstamp()) ? $calCategory->getTstamp()->format('U') : null,
                'crdate' => is_object($calCategory->getCrdate()) ? $calCategory->getCrdate()->format('U') : null,
                'cruser_id' => $calCategory->getCruserId(),
                'hidden' => $calCategory->getHidden(),
                'starttime' => is_object($calCategory->getStarttime()) ? $calCategory->getStarttime()->format('U') : null,
                'endtime' => is_object($calCategory->getEndtime()) ? $calCategory->getEndtime()->format('U') : null,
                'sorting' => $calCategory->getSorting(),
                'sys_language_uid' => $calCategory->getSysLanguageUid(),
                'l10n_parent' => $calCategory->getLanguageParentUid(),
                'title' => $calCategory->getTitle(),
                'parentcategory' => is_object($calCategory->getParent()) ? $calCategory->getParent()->getUid() : null,
                // EXT:news
                //'images' => $row['icon'],
                'single_pid' => $calCategory->getSinglePid(),
                'import_id' => $calCategory->getUid(),
                'import_source' => static::IMPORT_TABLE,
            ];
            $importData[] = $importDataItem;
        }
        return $importData;
    }
}