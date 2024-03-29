<?php

namespace Kiefernwald\Affair\Tests\Services;

use Carbon\Carbon;
use Kiefernwald\Affair\Model\Event;
use Kiefernwald\Affair\Model\EventRegion;
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

    protected function setUp():void
    {
        $this->eventProvider = $this->getMockBuilder(EventProviderInterface::class)->getMockForAbstractClass();
        $this->affair = new Affair($this->eventProvider);
    }

    public static function tearDownAfterClass():void
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
        Carbon::setTestNow(Carbon::create(2018, 04, 28, 5, 12, 0));

        $testEvent = new Event();
        $testEvent->setTitle('Test title');
        $testEvent->setText('Test text');
        $testEvent->setPlace('Test place');
        $testEvent->setRegion(new EventRegion());
        $testEvent->setStart(Carbon::now());
        $testEvent->setEnd(Carbon::now()->addDay());
        $testEvent->setCreatedAt(Carbon::now());
        $testEvent->setUpdatedAt(Carbon::now());

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
                $testEvent->getRegion(),
                $testEvent->getStart(),
                $testEvent->getEnd()
            )
        );
    }

    /**
     * @dataProvider helperFunctionsDataProvider
     */
    public function testHelperFunctions(
        $startTime,
        $endTime,
        $expectedIsSingleDay,
        $expectedHasRelevantTime,
        $expectedHasEnd
    ) {
        $testEvent = new Event();
        $testEvent->setTitle('Test title');
        $testEvent->setText('Test text');
        $testEvent->setPlace('Test place');
        $testEvent->setRegion(new EventRegion());
        $testEvent->setStart($startTime);
        $testEvent->setEnd($endTime);

        $this->assertEquals($expectedIsSingleDay, $this->affair->eventIsSameDay($testEvent));
        $this->assertEquals($expectedHasRelevantTime, $this->affair->eventHasRelevantTime($testEvent));
        $this->assertEquals($expectedHasEnd, $this->affair->eventHasEnd($testEvent));
    }

    /**
     * Data provider for test of getEvents()
     *
     * @return array Test data
     */
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
                Carbon::create(2018, 04, 29, 8, 19, 0)->subMonths(3),
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

    /**
     * Data provider for helper functions
     *
     * @return array Test data
     */
    public function helperFunctionsDataProvider()
    {
        Carbon::setTestNow(Carbon::create(2018, 04, 28, 5, 12, 0));
        return [
            [
                Carbon::create(2018, 04, 29, 9, 0, 0),
                Carbon::create(2018, 04, 29, 15, 30, 0),
                true,
                true,
                true,
            ],
            [
                Carbon::create(2018, 04, 30, 9, 0, 0),
                Carbon::create(2018, 04, 30, 9, 0, 0),
                true,
                false,
                false,
            ],
            [
                Carbon::create(2018, 04, 29, 0, 0, 0),
                Carbon::create(2018, 04, 29, 0, 0, 0),
                true,
                false,
                false,
            ],
            [
                Carbon::create(2018, 04, 29, 0, 0, 0),
                Carbon::create(2018, 04, 29, 0, 0, 1),
                true,
                true,
                true,
            ],
            [
                Carbon::create(2018, 04, 29, 9, 0, 0),
                Carbon::create(2018, 04, 30, 15, 30, 0),
                false,
                true,
                true,
            ],
            [
                Carbon::create(2018, 04, 29, 0, 0, 0),
                Carbon::create(2018, 04, 30, 0, 0, 0),
                false,
                false,
                true,
            ],
        ];
    }
}
