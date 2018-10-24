<?php

namespace WebentwicklerAt\NewsCalImporter\Service\Import\DataProvider;

abstract class AbstractImportDataProviderService
{
    /**
     * @param int $offset
     * @param int $numberOfRecordsPerRun
     * @return array
     */
    abstract public function getImportData($offset, $numberOfRecordsPerRun);
}