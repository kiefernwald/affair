<?php

namespace Kiefernwald\Affair\Tests\Services;

use Carbon\Carbon;
use Kiefernwald\Affair\Model\Event;
use Kiefernwald\Affair\Model\EventPlace;
use Kiefernwald\Affair\Services\Affair;
use Kiefernwald\Affair\Services\AffairInterface;
use Kiefernwald\Affair\Services\EventProviderInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * Unit tests for Affair service
 *
 * @package Kiefernwald\Affair\Tests\Services
 */
class AffairTest extends TestCase
{
    /**
     * @var MockObject|EventProviderInterface $eventProvider
     */
    protected $eventProvider;

    /**
     * @var Affair $affair
     */
    protected $affair;

    const EVENT_ID = 456;

    protected function setUp()
    {
        $this->eventProvider = $this->getMockBuilder(EventProviderInterface::class)->getMockForAbstractClass();
        $this->affair = new Affair($this->eventProvider);
    }

    public static function tearDownAfterClass()
    {
        Carbon::setTestNow();
    }


    /**
     * @dataProvider getEventsDataProvider
     */
    public function testGetEvents($expectedStart, $expectedEnd, $expectedMaxResults, $start, $end, $place, $maxResults)
    {
        $result = [new Event(), new Event()];
        $this->eventProvider
            ->expects($this->any())
            ->method('provideMany')
            ->with($expectedStart, $expectedEnd, $place, $expectedMaxResults)
            ->will($this->returnValue($result));

        $this->assertEquals($result, $this->affair->getEvents($start, $end, $place, $maxResults));
    }

    public function testGetEvent()
    {
        $result = new Event();
        $result->setText('Test text');

        $this->eventProvider
            ->expects($this->once())
            ->method('provideSingle')
            ->with(self::EVENT_ID)
            ->will($this->returnValue($result));

        $this->assertEquals($result, $this->affair->getEvent(self::EVENT_ID));
    }

    public function testCreateEvent()
    {
        $testEvent = new Event();
        $testEvent->setTitle('Test title');
        $testEvent->setText('Test text');
        $testEvent->setPlace(new EventPlace());
        $testEvent->setStart(Carbon::now());
        $testEvent->setEnd(Carbon::now()->addDay());

        $this->eventProvider
            ->expects($this->once())
            ->method('storeEvent')
            ->with($this->equalTo($testEvent))
            ->will($this->returnArgument(0));

        $this->assertEquals(
            $testEvent,
            $this->affair->createEvent(
                $testEvent->getTitle(),
                $testEvent->getText(),
                $testEvent->getPlace(),
                $testEvent->getStart(),
                $testEvent->getEnd()
            )
        );
    }

    public function getEventsDataProvider()
    {
        Carbon::setTestNow(Carbon::create(2018, 04, 28, 5, 12, 0));
        return [
            [
                Carbon::create(2018, 04, 29, 8, 15, 0),
                Carbon::create(2018, 04, 29, 8, 19, 0),
                AffairInterface::MAX_EVENTS,
                Carbon::create(2018, 04, 29, 8, 15, 0),
                Carbon::create(2018, 04, 29, 8, 19, 0),
                null,
                AffairInterface::MAX_EVENTS
            ],
            [
                Carbon::now(),
                Carbon::create(2018, 04, 29, 8, 19, 0),
                AffairInterface::MAX_EVENTS,
                null,
                Carbon::create(2018, 04, 29, 8, 19, 0),
                null,
                AffairInterface::MAX_EVENTS
            ],
            [
                Carbon::now(),
                Carbon::now()->addMonths(3),
                AffairInterface::MAX_EVENTS,
                null,
                null,
                null,
                AffairInterface::MAX_EVENTS
            ],
        ];
    }
}
