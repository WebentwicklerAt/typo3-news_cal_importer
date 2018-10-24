<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

call_user_func(function ($_EXTKEY) {
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['extbase']['commandControllers'][$_EXTKEY] =
        \WebentwicklerAt\NewsCalImporter\Command\NewsCalImporterCommandController::class;

    /** @var \TYPO3\CMS\Extbase\SignalSlot\Dispatcher $signalSlotDispatcher */
    $signalSlotDispatcher = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(TYPO3\CMS\Extbase\SignalSlot\Dispatcher::class);
    $signalSlotDispatcher->connect(
        GeorgRinger\News\Domain\Service\NewsImportService::class,
        'postHydrate',
        WebentwicklerAt\NewsCalImporter\Slots\NewsImportServiceSlot::class,
        'postHydrateSlot',
        true
    );
}, $_EXTKEY);