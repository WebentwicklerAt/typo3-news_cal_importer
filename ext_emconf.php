<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Cal importer',
    'description' => 'EXT:cal importer for EXT:news/EXT:eventnews.',
    'version' => '0.0.0',
    'category' => 'be',
    'constraints' => [
        'depends' => [
            'typo3' => '7.6.0-8.7.99',
            'news' => '5.3.0-7.0.99',
            'eventnews' => '2.0.0-2.1.99',
        ],
        'conflicts' => [
        ],
        'suggests' => [
        ],
    ],
    'state' => 'beta',
    'uploadfolder' => false,
    'createDirs' => '',
    'clearCacheOnLoad' => false,
    'author' => 'Gernot Leitgab',
    'author_company' => 'Webentwickler.at',
    'autoload' => [
        'psr-4' => [
            'WebentwicklerAt\\NewsCalImporter\\' => 'Classes',
        ],
    ],
];
