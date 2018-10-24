<?php

namespace WebentwicklerAt\NewsCalImporter\Jobs;

class CalCategoryImportJob extends AbstractImportJob
{
    /**
     * @var int
     */
    protected $numberOfRecordsPerRun = 50;

    /**
     * @param \WebentwicklerAt\NewsCalImporter\Service\Import\DataProvider\CalCategoryImportDataProviderService $importDataProviderService
     */
    public function injectImportDataProviderService(
        \WebentwicklerAt\NewsCalImporter\Service\Import\DataProvider\CalCategoryImportDataProviderService $importDataProviderService
    )
    {
        $this->importDataProviderService = $importDataProviderService;
    }

    /**
     * @param \WebentwicklerAt\NewsCalImporter\Domain\Service\CategoryImportService $importService
     */
    public function injectImportService(
        \WebentwicklerAt\NewsCalImporter\Domain\Service\CategoryImportService $importService
    )
    {
        $this->importService = $importService;
    }
}