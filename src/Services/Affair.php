<?php

namespace Kiefernwald\Affair\Services;

use Carbon\Carbon;
use Kiefernwald\Affair\Model\Event;
use Kiefernwald\Affair\Model\EventPlace;

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
     * @param EventPlace|null $place Place to filter by
     * @param int|null $maxResults Max number of results to be returned
     *
     * @return array<Event> List of events (empty if none was found)
     */
    public function getEvents(?Carbon $start = null, ?Carbon $end = null, ?EventPlace $place = null, ?int $maxResults = self::MAX_EVENTS): array
    {
        if (empty($start)) {
            $start = Carbon::now();
        }
        if (empty($end)) {
            $end = Carbon::now()->addMonths(3);
        }

        return $this->eventProvider->provideMany($start, $end, $place, $maxResults);
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
    ): Event
    {
        $event = new Event();
        $event->setTitle($title);
        $event->setText($text);
        $event->setStart($start);
        $event->setEnd($end);
        $event->setPlace($place);

        $this->eventProvider->storeEvent($event);

        return $event;
    }
}
