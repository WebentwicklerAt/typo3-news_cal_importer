<?php

namespace WebentwicklerAt\NewsCalImporter\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class CalCategory extends AbstractEntity
{
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
    protected $sorting;

    /**
     * @param int $sorting
     * @return void
     */
    public function setSorting($sorting)
    {
        $this->sorting = $sorting;
    }

    /**
     * @return int
     */
    public function getSorting()
    {
        return $this->sorting;
    }

    /**
     * @var \WebentwicklerAt\NewsCalImporter\Domain\Model\CalCategory
     */
    protected $parent;

    /**
     * @param \WebentwicklerAt\NewsCalImporter\Domain\Model\CalCategory $parent
     * @return void
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    /**
     * @return \WebentwicklerAt\NewsCalImporter\Domain\Model\CalCategory
     */
    public function getParent()
    {
        return $this->parent;
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
     * @var int
     */
    protected $singlePid;

    /**
     * @param int $singlePid
     * @return void
     */
    public function setSinglePid($singlePid)
    {
        $this->singlePid = $singlePid;
    }

    /**
     * @return int
     */
    public function getSinglePid()
    {
        return $this->singlePid;
    }
}