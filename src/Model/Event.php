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
     * Event id
     *
     * @var string $id
     */
    protected $id;

    /**
     * Event title
     *
     * @var string $title
     */
    protected $title;

    /**
     * Event description
     *
     * @var string $text
     */
    protected $text;

    /**
     * Place this event happens at
     *
     * @var string $place
     */
    protected $place;

    /**
     * Region this event happens at
     *
     * @var EventRegion $region
     */
    protected $region;

    /**
     * Moment of start
     *
     * @var Carbon $start
     */
    protected $start;

    /**
     * Moment of end
     *
     * @var Carbon $end
     */
    protected $end;

    /**
     * Moment of event creation
     *
     * @var Carbon $createdAt
     */
    protected $createdAt;

    /**
     * Moment of last event change
     *
     * @var Carbon $updatedAt
     */
    protected $updatedAt;

    /**
     * Getter for id
     *
     * @return string Current id
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Setter for id
     *
     * @param string $id New id
     *
     * @return void
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * Getter for title
     *
     * @return string Current title
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Setter for title
     *
     * @param string $title New title
     *
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * Getter for text
     *
     * @return string Current text
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * Setter for text
     *
     * @param string $text New text
     *
     * @return void
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }

    /**
     * Getter for place
     *
     * @return string Current place
     */
    public function getPlace(): string
    {
        return $this->place;
    }

    /**
     * Setter for place
     *
     * @param string $place New place
     *
     * @return void
     */
    public function setPlace(string $place): void
    {
        $this->place = $place;
    }

    /**
     * Getter for region
     *
     * @return EventRegion Current region
     */
    public function getRegion(): EventRegion
    {
        return $this->region;
    }

    /**
     * Setter for region
     *
     * @param EventRegion $region New region
     *
     * @return void
     */
    public function setRegion(EventRegion $region): void
    {
        $this->region = $region;
    }

    /**
     * Getter for start
     *
     * @return Carbon Current start
     */
    public function getStart(): Carbon
    {
        return $this->start;
    }

    /**
     * Setter for start
     *
     * @param Carbon $start New start
     *
     * @return void
     */
    public function setStart(Carbon $start): void
    {
        $this->start = $start;
    }

    /**
     * Getter for end
     *
     * @return Carbon Current end
     */
    public function getEnd(): Carbon
    {
        return $this->end;
    }

    /**
     * Setter for end
     *
     * @param Carbon $end New end
     *
     * @return void
     */
    public function setEnd(Carbon $end): void
    {
        $this->end = $end;
    }

    /**
     * Getter for createdAt
     *
     * @return Carbon Current createdAt
     */
    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }

    /**
     * Setter for createdAt
     *
     * @param Carbon $createdAt New createdAt
     *
     * @return void
     */
    public function setCreatedAt(Carbon $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * Getter for updatedAt
     *
     * @return Carbon Current updatedAt
     */
    public function getUpdatedAt(): Carbon
    {
        return $this->updatedAt;
    }

    /**
     * Setter for updatedAt
     *
     * @param Carbon $updatedAt New updatedAt
     *
     * @return void
     */
    public function setUpdatedAt(Carbon $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
