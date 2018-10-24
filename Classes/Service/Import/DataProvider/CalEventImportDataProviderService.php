<?php

namespace WebentwicklerAt\NewsCalImporter\Service\Import\DataProvider;

use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use WebentwicklerAt\NewsCalImporter\Domain\Model\CalEvent;

class CalEventImportDataProviderService extends AbstractImportDataProviderService
{
    const IMPORT_TABLE = 'tx_cal_event';

    /**
     * @var \WebentwicklerAt\NewsCalImporter\Domain\Repository\CalEventRepository
     */
    protected $calEventRepository;

    /**
     * @param \WebentwicklerAt\NewsCalImporter\Domain\Repository\CalEventRepository $eventRepository
     */
    public function injectEventRepository(\WebentwicklerAt\NewsCalImporter\Domain\Repository\CalEventRepository $calEventRepository)
    {
        $this->calEventRepository = $calEventRepository;
    }

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
     * @return int
     */
    public function getTotalRecordCount()
    {
        return $this->calEventRepository->countToImport();
    }

    /**
     * @param int $offset
     * @param int $numberOfRecordsPerRun
     * @return array
     */
    public function getImportData($offset, $numberOfRecordsPerRun)
    {
        $importData = [];
        $calEvents = $this->calEventRepository->findToImport($offset, $numberOfRecordsPerRun);
        /** @var CalEvent $calEvent */
        foreach ($calEvents as $calEvent) {
            $importDataItem = [
                // EXT:news
                'pid' => $calEvent->getPid(),
                'tstamp' => is_object($calEvent->getTstamp()) ? $calEvent->getTstamp()->format('U') : null,
                'crdate' => is_object($calEvent->getCrdate()) ? $calEvent->getCrdate()->format('U') : null,
                'cruser_id' => $calEvent->getCruserId(),
                'sys_language_uid' => $calEvent->getSysLanguageUid(),
                'l10n_parent' => $calEvent->getLanguageParentUid(),
                'hidden' => $calEvent->getHidden(),
                'starttime' => is_object($calEvent->getStarttime()) ? $calEvent->getStarttime()->format('U') : null,
                'endtime' => is_object($calEvent->getEndtime()) ? $calEvent->getEndtime()->format('U') : null,
                'title' => $calEvent->getTitle(),
                'teaser' => $calEvent->getTeaser(),
                'bodytext' => $calEvent->getDescription(),
                'datetime' => is_object($calEvent->getEventStart()) ? $calEvent->getEventStart()->format('U') : null,
                'categories' => $this->convertCategories($calEvent->getCategoryUidArray()),
                'related_files' => $this->convertFiles($calEvent),
                'type' => ($calEvent->getType() == 1 || $calEvent->getType() == 2) ? $calEvent->getType() : 0,
                'media' => $this->convertImages($calEvent),
                'internalurl' => $calEvent->getPage(),
                'externalurl' => $calEvent->getExtUrl(),
                'import_id' => $calEvent->getUid(),
                'import_source' => static::IMPORT_TABLE,
                // EXT:eventnews
                'is_event' => true,
                'full_day' => $calEvent->getAllday(),
                'event_end' => is_object($calEvent->getEventEnd()) ? $calEvent->getEventEnd()->format('U') : null,
                //'organizer' => $row['organizer_id'],
                //'location' => $row['location_id'],
                'organizer_simple' => $calEvent->getOrganizer(),
                'location_simple' => $calEvent->getLocation(),
            ];
            $importData[] = $importDataItem;
        }
        return $importData;
    }

    /**
     * @param array $calCategories
     * @return array
     */
    protected function convertCategories(array $calCategories)
    {
        $categories = [];
        foreach ($calCategories as $calCategory) {
            $category = $this->categoryRepository->findOneByImportSourceAndImportId(
                CalCategoryImportDataProviderService::IMPORT_TABLE,
                $calCategory
            );
            if (is_object($category)) {
                $categories[] = $category->getUid();
            }
        }
        return $categories;
    }

    /**
     * @param CalEvent $calEvent
     * @return array
     */
    protected function convertFiles(CalEvent $calEvent)
    {
        $files = [];
        /** @var FileReference $attachment */
        foreach ($calEvent->getAttachment() as $attachment) {
            $files[] = [
                'file' => $attachment->getOriginalResource()->getCombinedIdentifier(),
                'title' => $attachment->getOriginalResource()->getTitle(),
                'description' => $attachment->getOriginalResource()->getDescription(),
                'pid' => $attachment->getPid(),
            ];
        }
        return $files;
    }

    /**
     * @param CalEvent $calEvent
     * @return array
     */
    protected function convertImages(CalEvent $calEvent)
    {
        $images = [];
        $count = 0;
        /** @var FileReference $image */
        foreach ($calEvent->getImage() as $image) {
            $images[] = [
                'image' => $image->getOriginalResource()->getCombinedIdentifier(),
                'title' => $image->getOriginalResource()->getTitle(),
                'alt' => $image->getOriginalResource()->getAlternative(),
                'caption' => $image->getOriginalResource()->getDescription(),
                'showinpreview' => ($count == 0),
                'pid' => $image->getPid(),
            ];
            ++$count;
        }
        return $images;
    }
}