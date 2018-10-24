<?php

namespace WebentwicklerAt\NewsCalImporter\Service\Migration;

use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Database\DatabaseConnection;
use TYPO3\CMS\Core\DataHandling\DataHandler;
use TYPO3\CMS\Core\SingletonInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class CalToSysCategoryMigrationService implements SingletonInterface
{
    /**
     * @var array
     */
    protected $calCategoryUidToSysCategoryUidCache = [];

    /**
     * @var \GeorgRinger\News\Domain\Repository\CategoryRepository
     */
    protected $categoryRepository;

    /**
     * @param \GeorgRinger\News\Domain\Repository\CategoryRepository $categoryRepository
     */
    public function injectCategoryRepository(\GeorgRinger\News\Domain\Repository\CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return array
     */
    public function migrate()
    {
        $errors = [];
        $errors += $this->migrateAllowedCalCategoryToSysCategoryMounts('be_groups');
        $errors += $this->migrateAllowedCalCategoryToSysCategoryMounts('be_users');
        return $errors;
    }

    /**
     * @param string $table
     * @return array
     */
    protected function migrateAllowedCalCategoryToSysCategoryMounts($table)
    {
        $data = [];
        $rows = $this->getDatabaseConnection()->exec_SELECTgetRows(
            'uid,category_perms,tx_cal_category',
            $table,
            'tx_cal_enable_accesscontroll <> 0 AND tx_cal_category <> \'\'' . BackendUtility::BEenableFields($table)
        );
        foreach ($rows as $row) {
            $sysCategoryUids = GeneralUtility::intExplode(',', $row['category_perms']);
            $calCategoryUids = GeneralUtility::intExplode(',', $row['tx_cal_category']);
            $convertedCalCategoryUids = [];
            foreach ($calCategoryUids as $calCategoryUid) {
                $sysCategoryUid = $this->convertCalCategoryUidToSysCategoryUid($calCategoryUid);
                if ($sysCategoryUid) {
                    $sysCategoryUids[] = $sysCategoryUid;
                    $convertedCalCategoryUids[] = $calCategoryUid;
                }
            }
            if (count($convertedCalCategoryUids)) {
                $categoryPerms = array_unique($sysCategoryUids);
                $data[$table][$row['uid']] = [
                    'category_perms' => implode(',', $categoryPerms),
                ];
            }
        }
        /** @var DataHandler $dataHandler */
        $dataHandler = GeneralUtility::makeInstance(DataHandler::class);
        $dataHandler->start($data, []);
        $dataHandler->admin = true;
        $dataHandler->process_datamap();
        return $dataHandler->errorLog;
    }

    /**
     * @param int $calCategoryUid
     * @return int
     */
    protected function convertCalCategoryUidToSysCategoryUid($calCategoryUid)
    {
        if (array_key_exists($calCategoryUid, $this->calCategoryUidToSysCategoryUidCache)) {
            return $this->calCategoryUidToSysCategoryUidCache[$calCategoryUid];
        }
        $sysCategory = $this->categoryRepository->findOneByImportSourceAndImportId(
            'tx_cal_category',
            (int)$calCategoryUid
        );
        if ($sysCategory) {
            $this->calCategoryUidToSysCategoryUidCache[$calCategoryUid] = (int)$sysCategory->getUid();
            return $this->calCategoryUidToSysCategoryUidCache[$calCategoryUid];
        }
        return null;
    }

    /**
     * @return DatabaseConnection
     */
    protected function getDatabaseConnection()
    {
        return $GLOBALS['TYPO3_DB'];
    }
}