<?php

namespace Kiefernwald\Affair\Services;

use Carbon\Carbon;
use Kiefernwald\Affair\Model\Event;
use Kiefernwald\Affair\Model\EventPlace;

/**
 * Interface describing a data provider
 *
 * @package Kiefernwald\Affair\Services
 */
interface EventProviderInterface
{
    /**
     * Returns a single event by id
     *
     * @param string $eventId Event id
     * @return Event
     */
    public function provideSingle(string $eventId): Event;

    /**
     * Returns many events.
     *
     * @param Carbon $start Start date
     * @param Carbon $end End date
     * @param EventPlace|null $place Place to filter by
     * @param int $maxResults Max number of results
     * @return array
     */
    public function provideMany(
        Carbon $start,
        Carbon $end,
        ?EventPlace $place = null,
        int $maxResults = AffairInterface::MAX_EVENTS
    ): array;

    /**
     * Stores an event.
     *
     * @param Event $event Event to store
     * @return void
     */
    public function storeEvent(Event $event);
}
