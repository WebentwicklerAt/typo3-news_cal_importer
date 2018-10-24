<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

call_user_func(function ($_EXTKEY) {
    $llbe = 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_be.xlf:';

    \GeorgRinger\News\Utility\ImportJob::register(
        \WebentwicklerAt\NewsCalImporter\Jobs\CalCategoryImportJob::class,
        $llbe . 'CalCategoryImportJob.title',
        $llbe . 'CalCategoryImportJob.description'
    );
    \GeorgRinger\News\Utility\ImportJob::register(
        \WebentwicklerAt\NewsCalImporter\Jobs\CalEventImportJob::class,
        $llbe . 'CalEventImportJob.title',
        $llbe . 'CalEventImportJob.description'
    );
}, $_EXTKEY);
