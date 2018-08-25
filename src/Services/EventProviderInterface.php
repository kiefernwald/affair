<?php

namespace Kiefernwald\Affair\Services;
use Carbon\Carbon;
use Kiefernwald\Affair\Model\Event;

/**
 * Interface describing a data provider
 *
 * @package Kiefernwald\Affair\Services
 */
interface EventProviderInterface
{
    public function provideSingle(string $eventId);

    /**
     * @param Carbon $start Start date
     * @param Carbon|null $end End date
     * @param int $maxResults Max number of results
     * @return array
     */
    public function provideMany(
        Carbon $start,
        ?Carbon $end = null,
        int $maxResults = AffairInterface::MAX_EVENTS
    ): array;

    public function storeEvent(Event $event);
}
