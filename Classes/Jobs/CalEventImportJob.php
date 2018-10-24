<?php

namespace WebentwicklerAt\NewsCalImporter\Jobs;

class CalEventImportJob extends AbstractImportJob
{
    /**
     * @var int
     */
    protected $numberOfRecordsPerRun = 50;

    /**
     * @param \WebentwicklerAt\NewsCalImporter\Service\Import\DataProvider\CalEventImportDataProviderService $importDataProviderService
     */
    public function injectImportDataProviderService(
        \WebentwicklerAt\NewsCalImporter\Service\Import\DataProvider\CalEventImportDataProviderService $importDataProviderService
    )
    {
        $this->importDataProviderService = $importDataProviderService;
    }

    /**
     * @param \GeorgRinger\News\Domain\Service\NewsImportService $importService
     */
    public function injectImportService(
        \GeorgRinger\News\Domain\Service\NewsImportService $importService
    )
    {
        $this->importService = $importService;
    }
}