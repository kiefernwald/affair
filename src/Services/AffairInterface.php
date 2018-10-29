<?php

namespace Kiefernwald\Affair\Services;

use Carbon\Carbon;
use Kiefernwald\Affair\Model\Event;
use Kiefernwald\Affair\Model\EventRegion;

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
     * @param Carbon|null $end Moment of end (defaults to +3 months if not given)
     * @param EventRegion|null $region Place to filter by
     * @param int|null $maxResults Max number of results to be returned
     *
     * @return array<Event> List of events (empty if none was found)
     */
    public function getEvents(?Carbon $start = null, ?Carbon $end = null, ?EventRegion $region = null, ?int $maxResults = self::MAX_EVENTS): array;

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
     * @param string $place Place of event
     * @param EventRegion $region Region of event
     * @param Carbon $start Start date (time is optional)
     * @param Carbon|null $end End date (time is optional)
     * @return Event Created event
     */
    public function createEvent(
        string $title,
        string $text,
        string $place,
        EventRegion $region,
        Carbon $start,
        ?Carbon $end = null
    ): Event;

    /**
     * Checks if the given event spans over a single day
     *
     * @param Event $event Event
     * @return bool true if event starts and ends on the same day
     */
    public function eventIsSingleDay(Event $event): bool;

    /**
     * Checks if the given event has a relevant start time
     *
     * @param Event $event Event
     * @return bool true if event start time is different from 00:00
     */
    public function eventHasStartTime(Event $event): bool;

    /**
     * Checks if the given event has a relevant end time
     *
     * @param Event $event Event
     * @return bool true if event start time and end time are different
     */
    public function eventHasEndTime(Event $event): bool;
}
