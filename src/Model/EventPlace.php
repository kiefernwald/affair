<?php

namespace Kiefernwald\Affair\Model;

/**
 * Event place model
 *
 * @package Kiefernwald\Affair\Model
 */
class EventPlace
{
    /**
     * @var string $title Title of place.
     */
    protected $title;

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
}
