<?php

namespace WebentwicklerAt\NewsCalImporter\Command;

use TYPO3\CMS\Extbase\Mvc\Controller\CommandController;
use WebentwicklerAt\NewsCalImporter\Service\Migration\CalToNewsContentElementMigrationService;
use WebentwicklerAt\NewsCalImporter\Service\Migration\CalToSysCategoryMigrationService;

class NewsCalImporterCommandController extends CommandController
{
    /**
     * Migrate EXT:cal 'allowed categories' to system 'category mounts' of be_users and be_groups
     * @return void
     */
    public function migrateCalToSysCategoryCommand()
    {
        /** @var CalToSysCategoryMigrationService $migrationService */
        $migrationService = $this->objectManager->get(CalToSysCategoryMigrationService::class);
        $errors = $migrationService->migrate();
        foreach ($errors as $error) {
            $this->output('<error>' . $error . '</error>' . PHP_EOL);
        }
    }

    /**
     * Migrate content elements from EXT:cal to EXT:news
     * @return void
     */
    public function migrateCalToNewsContentElementCommand()
    {
        /** @var CalToNewsContentElementMigrationService $calToSysCategoryMigrationService */
        $migrationService = $this->objectManager->get(CalToNewsContentElementMigrationService::class);
        $errors = $migrationService->migrate();
        foreach ($errors as $error) {
            $this->output('<error>' . $error . '</error>' . PHP_EOL);
        }
    }
}