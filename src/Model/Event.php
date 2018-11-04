<?php

namespace Kiefernwald\Affair\Model;

use Carbon\Carbon;

/**
 * Event model
 *
 * @package Kiefernwald\Affair\Model
 */
class Event
{
    /**
     * @var string $id Event id
     */
    protected $id;

    /**
     * @var string $title Event title
     */
    protected $title;

    /**
     * @var string $text Event description
     */
    protected $text;

    /**
     * @var string $place Place this event happens at
     */
    protected $place;

    /**
     * @var EventRegion $region Region this event happens at
     */
    protected $region;

    /**
     * @var Carbon $start Moment of start
     */
    protected $start;

    /**
     * @var Carbon $end Moment of end
     */
    protected $end;

    /**
     * @var Carbon $createdAt Moment of event creation
     */
    protected $createdAt;

    /**
     * @var Carbon $updatedAt Moment of last event change
     */
    protected $updatedAt;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * @return string
     */
    public function getPlace(): string
    {
        return $this->place;
    }

    /**
     * @param string $place
     */
    public function setPlace(string $place): void
    {
        $this->place = $place;
    }

    /**
     * @return EventRegion
     */
    public function getRegion(): EventRegion
    {
        return $this->region;
    }

    /**
     * @param EventRegion $region
     */
    public function setRegion(EventRegion $region): void
    {
        $this->region = $region;
    }

    /**
     * @return Carbon
     */
    public function getStart(): Carbon
    {
        return $this->start;
    }

    /**
     * @param Carbon $start
     */
    public function setStart(Carbon $start): void
    {
        $this->start = $start;
    }

    /**
     * @return Carbon
     */
    public function getEnd(): Carbon
    {
        return $this->end;
    }

    /**
     * @param Carbon $end
     */
    public function setEnd(Carbon $end): void
    {
        $this->end = $end;
    }

    /**
     * @return Carbon
     */
    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }

    /**
     * @param Carbon $createdAt
     */
    public function setCreatedAt(Carbon $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return Carbon
     */
    public function getUpdatedAt(): Carbon
    {
        return $this->updatedAt;
    }

    /**
     * @param Carbon $updatedAt
     */
    public function setUpdatedAt(Carbon $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
