<?php

namespace Kiefernwald\Affair\Services;

use Carbon\Carbon;
use Kiefernwald\Affair\Model\Event;
use Kiefernwald\Affair\Model\EventPlace;

/**
 * Main service interface
 *
 * @package Kiefernwald\Affair\Services
 */
interface AffairInterface
{
    const MAX_EVENTS = 30;

    /**
     * Returns events between a given (inclusive) start and end date.
     *
     * @param Carbon|null $start Moment of start (defaults to now if not given)
     * @param Carbon|null $end Moment of end
     * @param int|null $maxResults Max number of results to be returned
     *
     * @return array<Event> List of events (empty if none was found)
     */
    public function getEvents(?Carbon $start = null, ?Carbon $end = null, ?int $maxResults = self::MAX_EVENTS): array;

    /**
     * Returns a single event by given ID.
     *
     * @param string $id Event id
     * @return Event|null Found event (null if none was found)
     */
    public function getEvent(string $id): ?Event;

    /**
     * Creates and stores a new Event.
     *
     * @param string $title Event title
     * @param string $text Event description
     * @param EventPlace $place Place of event
     * @param Carbon $start Start date (time is optional)
     * @param Carbon|null $end End date (time is optional)
     * @return Event Created event
     */
    public function createEvent(
        string $title,
        string $text,
        EventPlace $place,
        Carbon $start,
        ?Carbon $end = null
    ): Event;
}
