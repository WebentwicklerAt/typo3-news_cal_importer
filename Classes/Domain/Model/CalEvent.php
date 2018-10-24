<?php

namespace WebentwicklerAt\NewsCalImporter\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class CalEvent extends AbstractEntity
{
    const TYPE_EVENT = 0;
    const TYPE_PAGE = 1;
    const TYPE_URL = 2;
    const TYPE_MEETING = 3;
    const TYPE_TODO = 4;

    /**
     * @var int
     */
    protected $sysLanguageUid;

    /**
     * @param int $sysLanguageUid
     * @return void
     */
    public function setSysLanguageUid($sysLanguageUid)
    {
        $this->sysLanguageUid = $sysLanguageUid;
    }

    /**
     * @return int
     */
    public function getSysLanguageUid()
    {
        return $this->sysLanguageUid;
    }

    /**
     * @var int
     */
    protected $languageParentUid;

    /**
     * @param int $languageParentUid
     * @return void
     */
    public function setLanguageParentUid($languageParentUid)
    {
        $this->languageParentUid = $languageParentUid;
    }

    /**
     * @return int
     */
    public function getLanguageParentUid()
    {
        return $this->languageParentUid;
    }

    /**
     * @var \DateTime
     */
    protected $tstamp;

    /**
     * @param \DateTime $tstamp
     * @return void
     */
    public function setTstamp($tstamp)
    {
        $this->tstamp = $tstamp;
    }

    /**
     * @return \DateTime
     */
    public function getTstamp()
    {
        return $this->tstamp;
    }

    /**
     * @var \DateTime
     */
    protected $crdate;

    /**
     * @param \DateTime $crdate
     * @return void
     */
    public function setCrdate($crdate)
    {
        $this->crdate = $crdate;
    }

    /**
     * @return \DateTime
     */
    public function getCrdate()
    {
        return $this->crdate;
    }

    /**
     * @var int
     */
    protected $cruserId;

    /**
     * @param int $cruserId
     * @return void
     */
    public function setCruserId($cruserId)
    {
        $this->cruserId = $cruserId;
    }

    /**
     * @return int
     */
    public function getCruserId()
    {
        return $this->cruserId;
    }

    /**
     * @var bool
     */
    protected $hidden;

    /**
     * @param bool $hidden
     * @return void
     */
    public function setHidden($hidden)
    {
        $this->hidden = $hidden ? true : false;
    }

    /**
     * @return bool
     */
    public function getHidden()
    {
        return $this->hidden ? true : false;
    }

    /**
     * @var \DateTime
     */
    protected $starttime;

    /**
     * @param \DateTime $starttime
     * @return void
     */
    public function setStarttime($starttime)
    {
        $this->starttime = $starttime;
    }

    /**
     * @return \DateTime
     */
    public function getStarttime()
    {
        return $this->starttime;
    }

    /**
     * @var \DateTime
     */
    protected $endtime;

    /**
     * @param \DateTime $endtime
     * @return void
     */
    public function setEndtime($endtime)
    {
        $this->endtime = $endtime;
    }

    /**
     * @return \DateTime
     */
    public function getEndtime()
    {
        return $this->endtime;
    }

    /**
     * @var int
     */
    protected $calStartDate;

    /**
     * @param int $calStartDate
     * @return void
     */
    public function setCalStartDate($calStartDate)
    {
        $this->calStartDate = $calStartDate;
    }

    /**
     * @return int
     */
    public function getCalStartDate()
    {
        return $this->calStartDate;
    }

    /**
     * @var int
     */
    protected $calEndDate;

    /**
     * @param int $calEndDate
     * @return void
     */
    public function setCalEndDate($calEndDate)
    {
        $this->calEndDate = $calEndDate;
    }

    /**
     * @return int
     */
    public function getCalEndDate()
    {
        return $this->calEndDate;
    }

    /**
     * @var int
     */
    protected $calStartTime;

    /**
     * @param int $calStartTime
     * @return void
     */
    public function setCalStartTime($calStartTime)
    {
        $this->calStartTime = $calStartTime;
    }

    /**
     * @return int
     */
    public function getCalStartTime()
    {
        return $this->calStartTime;
    }

    /**
     * @var int
     */
    protected $calEndTime;

    /**
     * @param int $calEndTime
     * @return void
     */
    public function setCalEndTime($calEndTime)
    {
        $this->calEndTime = $calEndTime;
    }

    /**
     * @return int
     */
    public function getCalEndTime()
    {
        return $this->calEndTime;
    }

    /**
     * @var bool
     */
    protected $allday;

    /**
     * @param bool $allday
     * @return void
     */
    public function setAllday($allday)
    {
        $this->allday = $allday ? true : false;
    }

    /**
     * @return bool
     */
    public function getAllday()
    {
        return $this->allday ? true : false;
    }

    /**
     * @var string
     */
    protected $timezone;

    /**
     * @param string $timezone
     * @return void
     */
    public function setTimezone($timezone)
    {
        $this->timezone = $timezone;
    }

    /**
     * @return string
     */
    public function getTimezone()
    {
        return $this->timezone;
    }

    /**
     * @var string
     */
    protected $title;

    /**
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\WebentwicklerAt\NewsCalImporter\Domain\Model\CalCategory>
     */
    protected $category;

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\WebentwicklerAt\NewsCalImporter\Domain\Model\CalCategory> $category
     * @return void
     */
    public function setCategory(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $category)
    {
        $this->category = $category;
    }

    /**
     * @param \WebentwicklerAt\NewsCalImporter\Domain\Model\CalCategory $category
     * @return void
     */
    public function addCategory(\WebentwicklerAt\NewsCalImporter\Domain\Model\CalCategory $category)
    {
        if ($this->category === null) {
            $this->category = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        }
        $this->category->attach($category);
    }

    /**
     * @param \WebentwicklerAt\NewsCalImporter\Domain\Model\CalCategory $category
     * @return void
     */
    public function removeCategory(\WebentwicklerAt\NewsCalImporter\Domain\Model\CalCategory $category)
    {
        if ($this->category === null) {
            $this->category = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        }
        $this->category->detach($category);
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    public function getCategory()
    {
        if ($this->category === null) {
            $this->category = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        }
        return $this->category;
    }

    /**
     * @var string
     */
    protected $organizer;

    /**
     * @param string $organizer
     * @return void
     */
    public function setOrganizer($organizer)
    {
        $this->organizer = $organizer;
    }

    /**
     * @return string
     */
    public function getOrganizer()
    {
        return $this->organizer;
    }

    /**
     * @var string
     */
    protected $location;

    /**
     * @param string $location
     * @return void
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @var string
     */
    protected $teaser;

    /**
     * @param string $teaser
     * @return void
     */
    public function setTeaser($teaser)
    {
        $this->teaser = $teaser;
    }

    /**
     * @return string
     */
    public function getTeaser()
    {
        return $this->teaser;
    }

    /**
     * @var string
     */
    protected $description;

    /**
     * @param string $description
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @var int
     */
    protected $type;

    /**
     * @param int $type
     * @return void
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @var int
     */
    protected $page;

    /**
     * @param int $page
     * @return void
     */
    public function setPage($page)
    {
        $this->page = $page;
    }

    /**
     * @return int
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @var string
     */
    protected $extUrl;

    /**
     * @param string $extUrl
     * @return void
     */
    public function setExtUrl($extUrl)
    {
        $this->extUrl = $extUrl;
    }

    /**
     * @return string
     */
    public function getExtUrl()
    {
        return $this->extUrl;
    }

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     */
    protected $image;

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $image
     * @return void
     */
    public function setImage(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $image)
    {
        $this->image = $image;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     * @return void
     */
    public function addImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $image)
    {
        if ($this->image === null) {
            $this->image = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        }
        $this->image->attach($image);
    }

    /**
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     * @return void
     */
    public function removeImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $image)
    {
        if ($this->image === null) {
            $this->image = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        }
        $this->image->detach($image);
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    public function getImage()
    {
        if ($this->image === null) {
            $this->image = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        }
        return $this->image;
    }

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference>
     */
    protected $attachment;

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\TYPO3\CMS\Extbase\Domain\Model\FileReference> $attachment
     * @return void
     */
    public function setAttachment(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $attachment)
    {
        $this->attachment = $attachment;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $attachment
     * @return void
     */
    public function addAttachment(\TYPO3\CMS\Extbase\Domain\Model\FileReference $attachment)
    {
        if ($this->attachment === null) {
            $this->attachment = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        }
        $this->attachment->attach($attachment);
    }

    /**
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $attachment
     * @return void
     */
    public function removeAttachment(\TYPO3\CMS\Extbase\Domain\Model\FileReference $attachment)
    {
        if ($this->attachment === null) {
            $this->attachment = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        }
        $this->attachment->detach($attachment);
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    public function getAttachment()
    {
        if ($this->attachment === null) {
            $this->attachment = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        }
        return $this->attachment;
    }

    /**
     * @return \DateTime
     */
    public function getEventStart()
    {
        $timestamp = $this->convertToTimestamp($this->getCalStartDate(), $this->getCalStartTime());
        return $this->convertTimestampToDateTime($timestamp);
    }

    /**
     * @return \DateTime
     */
    public function getEventEnd()
    {
        $timestamp = $this->convertToTimestamp($this->getCalEndDate(), $this->getCalEndTime());
        return $this->convertTimestampToDateTime($timestamp);
    }

    /**
     * @param int $dateString
     * @param int $timeString
     * @return int
     */
    protected function convertToTimestamp($dateString, $timeString)
    {
        $year = substr($dateString, 0, 4);
        $month = substr($dateString, 4, 2);
        $day = substr($dateString, 6, 2);
        $hour = (int)($timeString / 3600);
        $minute = ($timeString % 3600) / 60;
        return gmmktime($hour, $minute, 0, $month, $day, $year);
    }

    /**
     * @param int $timestamp
     * @return \DateTime
     */
    protected function convertTimestampToDateTime($timestamp)
    {
        $dateTime = new \DateTime('@' . $timestamp);
        // timezone is ignored if timestamp is used as time, therefore modify with offset:
        $dateTimeZone = new \DateTimeZone(date_default_timezone_get());
        $offset = $dateTimeZone->getOffset($dateTime);
        $dateTime->modify(($offset > 0 ? '-' : '+') . ((int)$offset) . ' seconds');
        return $dateTime;
    }

    /**
     * @return array
     */
    public function getCategoryUidArray()
    {
        $categoryUidArray = [];
        /** @var CalCategory $category */
        foreach ($this->category as $category) {
            $categoryUidArray[] = $category->getUid();
        }
        return $categoryUidArray;
    }
}