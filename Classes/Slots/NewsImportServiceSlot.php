<?php

namespace WebentwicklerAt\NewsCalImporter\Slots;

use GeorgRinger\News\Domain\Model\News;
use GeorgRinger\News\Domain\Service\NewsImportService;

class NewsImportServiceSlot extends NewsImportService
{
    /**
     * @param array $importItem
     * @param News $news
     */
    public function postHydrateSlot(array $importItem, News $news)
    {
        $news->setIsEvent((bool)$importItem['is_event']);
        $news->setFullDay((bool)$importItem['full_day']);
        $news->setEventEnd(new \DateTime(date('Y-m-d H:i:sP', $importItem['event_end'])));
        $news->setOrganizerSimple($importItem['organizer_simple']);
        $news->setLocationSimple($importItem['location_simple']);

        return [
            'importItem' => $importItem,
            'news' => $news,
        ];
    }
}