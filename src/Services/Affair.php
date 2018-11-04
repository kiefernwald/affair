<?php

namespace Kiefernwald\Affair\Services;

use Carbon\Carbon;
use Kiefernwald\Affair\Model\Event;
use Kiefernwald\Affair\Model\EventRegion;

/**
 * Affair main service implementation
 *
 * @package Kiefernwald\Affair\Services
 */
class Affair implements AffairInterface
{

    /**
     * @var EventProviderInterface $eventProvider
     */
    protected $eventProvider;

    /**
     * Affair service constructor.
     *
     * @param EventProviderInterface $eventProvider
     */
    public function __construct(EventProviderInterface $eventProvider)
    {
        $this->eventProvider = $eventProvider;
    }

    /**
     * Returns events between a given (inclusive) start and end date.
     *
     * @param Carbon|null $start Moment of start (defaults to now if not given)
     * @param Carbon|null $end Moment of end (defaults to +3 months if not given)
     * @param EventRegion|null $region Region to filter by
     * @param int|null $maxResults Max number of results to be returned
     *
     * @return array<Event> List of events (empty if none was found)
     */
    public function getEvents(?Carbon $start = null, ?Carbon $end = null, ?EventRegion $region = null, ?int $maxResults = self::MAX_EVENTS): array
    {
        if (empty($start)) {
            $start = Carbon::now();
        }
        if (empty($end)) {
            $end = Carbon::now()->addMonths(3);
        }

        return $this->eventProvider->provideMany($start, $end, $region, $maxResults);
    }

    /**
     * Returns a single event by given ID.
     *
     * @param string $id Event id
     * @return Event|null Found event (null if none was found)
     */
    public function getEvent(string $id): ?Event
    {
        return $this->eventProvider->provideSingle($id);
    }

    /**
     * Creates and stores a new Event.
     *
     * @param string $title Event title
     * @param string $text Event description
     * @param string $place Place of event
     * @param EventRegion $region Region of event
     * @param Carbon $start Start date (time is optional)
     * @param Carbon|null $end End date (time is optional)
     * @param Carbon|null $createdAt Creation of event (set to now if not given)
     * @param Carbon|null $updatedAt Creation of event (set to now if not given)
     * @return Event Created event
     */
    public function createEvent(
        string $title,
        string $text,
        string $place,
        EventRegion $region,
        Carbon $start,
        ?Carbon $end = null,
        ?Carbon $createdAt = null,
        ?Carbon $updatedAt = null
    ): Event
    {
        $event = new Event();
        $event->setTitle($title);
        $event->setText($text);
        $event->setStart($start);
        $event->setEnd($end);
        $event->setPlace($place);
        $event->setRegion($region);
        $event->setCreatedAt($createdAt ?: Carbon::now());
        $event->setUpdatedAt($updatedAt ?: Carbon::now());

        $this->eventProvider->storeEvent($event);

        return $event;
    }

    /**
     * Checks if the given event spans over a single day
     *
     * @param Event $event Event
     * @return bool true if event starts and ends on the same day
     */
    public function eventIsSingleDay(Event $event): bool
    {
        return $event->getStart()->diffInDays($event->getEnd()) === 0;
    }

    /**
     * Checks if the given event has a relevant start time
     *
     * @param Event $event Event
     * @return bool true if event start time is different from 00:00
     */
    public function eventHasStartTime(Event $event): bool
    {
        return ($event->getStart()->hour !== 0)
            || ($event->getStart()->minute !== 0)
            || ($event->getStart()->second !== 0);
    }

    /**
     * Checks if the given event has a relevant end time
     *
     * @param Event $event Event
     * @return bool true if event start time and end time are different
     */
    public function eventHasEndTime(Event $event): bool
    {
        return ($event->getStart()->hour !== $event->getEnd()->hour)
            || ($event->getStart()->minute !== $event->getEnd()->minute)
            || ($event->getStart()->second !== $event->getEnd()->second);
    }
}
