<?php

namespace WebentwicklerAt\NewsCalImporter\Domain\Service;

class CategoryImportService extends \GeorgRinger\News\Domain\Service\CategoryImportService
{
    /**
     * @param array $importArray
     */
    public function import(array $importArray)
    {
        $this->logger->info(sprintf('Starting import for %s categories', count($importArray)));

        // Sort import array to import the default language first
        foreach ($importArray as $importItem) {
            $category = $this->hydrateCategory($importItem);

            // Store language overlay in post persist queue
            if ((int)$importItem['sys_language_uid'] > 0 && (string)$importItem['l10n_parent'] !== '0') {
                $this->postPersistQueue[$importItem['import_id'] . '-' . self::ACTION_CREATE_L10N_CHILDREN_CATEGORY] = [
                    'action' => self::ACTION_CREATE_L10N_CHILDREN_CATEGORY,
                    'category' => null,
                    'importItem' => $importItem
                ];
            }

            if ($importItem['parentcategory']) {
                $this->postPersistQueue[$importItem['import_id'] . '-' . self::ACTION_SET_PARENT_CATEGORY] = [
                    'category' => $category,
                    'action' => self::ACTION_SET_PARENT_CATEGORY,
                    'parentCategoryOriginUid' => $importItem['parentcategory']
                ];
            }
        }

        $this->persistenceManager->persistAll();

        foreach ($this->postPersistQueue as $queueItem) {
            switch ($queueItem['action']) {
                case self::ACTION_SET_PARENT_CATEGORY:
                    $this->setParentCategory($queueItem);
                    break;
                case self::ACTION_CREATE_L10N_CHILDREN_CATEGORY:
                    $this->createL10nChildrenCategory($queueItem);
                    break;
                default:
                    // do nothing
                    break;
            }
        }

        $this->persistenceManager->persistAll();
    }

    /**
     * Create l10n relation
     *
     * @param array $queueItem
     */
    protected function createL10nChildrenCategory(array $queueItem)
    {
        $importItem = $queueItem['importItem'];
        $parentCategory = $this->categoryRepository->findOneByImportSourceAndImportId(
            $importItem['import_source'],
            $importItem['l10n_parent']
        );

        if ($parentCategory !== null) {
            $category = $this->hydrateCategory($importItem);

            $category->setSysLanguageUid($importItem['sys_language_uid']);
            $category->setL10nParent($parentCategory->getUid());

            $this->categoryRepository->update($category);
        }
    }
}