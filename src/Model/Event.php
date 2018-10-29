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
     * @var EventPlace $place Place this event happens at
     */
    protected $place;

    /**
     * @var Carbon $start Moment of start
     */
    protected $start;

    /**
     * @var Carbon $end Moment of end
     */
    protected $end;

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
     * @return EventPlace
     */
    public function getPlace(): EventPlace
    {
        return $this->place;
    }

    /**
     * @param EventPlace $place
     */
    public function setPlace(EventPlace $place): void
    {
        $this->place = $place;
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
}
