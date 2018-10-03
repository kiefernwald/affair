# Affair 😍

[![Build Status](https://travis-ci.com/kiefernwald/affair.svg?branch=master)](https://travis-ci.com/kiefernwald/affair)

Affair is a simple library to take away some work when handling events.
It is the core of [Oberhavel.jetzt](https://oberhavel.jetzt) project.

## Installation

`composer require kiefernwald/affair`

## Usage

Implement your own `EventProvider`, following `EventProviderInterface`. It should handle access to your storage:

```php
<?php

use Carbon\Carbon;
use Kiefernwald\Affair\Model\Event;
use Kiefernwald\Affair\Model\EventPlace;
use Kiefernwald\Affair\Services\AffairInterface;
use Kiefernwald\Affair\Services\EventProviderInterface;

class MyEventProvider implements EventProviderInterface {

    public function provideSingle(string $eventId): Event
    {
        // ...
    }

    public function provideMany(
        Carbon $start,
        Carbon $end,
        ?EventPlace $place = null,
        int $maxResults = AffairInterface::MAX_EVENTS
    ): array
    {
        // ...
    }

    public function storeEvent(Event $event)
    {
        // ...
    }
}
```

Instantiate the main service in your code and pass it an instance of your event provider:

```php
    // ...

    $affair = new Affair(new MyEventProvider());

    // ...
```

Use the service's main methods:

* `getEvents` to get a list of events
* `getEvent` to get a single event by id
* `createEvent` to create and store a new event