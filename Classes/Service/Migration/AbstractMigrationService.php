<?php

namespace WebentwicklerAt\NewsCalImporter\Service\Migration;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\SignalSlot\Dispatcher;

abstract class AbstractMigrationService
{
    /**
     * @var Dispatcher
     */
    protected $signalSlotDispatcher;

    /**
     * AbstractMigrationService constructor.
     */
    public function __construct()
    {
        $this->signalSlotDispatcher = GeneralUtility::makeInstance(Dispatcher::class);
    }
}