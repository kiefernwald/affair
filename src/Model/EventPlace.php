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
     * @var string $id Id of place
     */
    protected $id;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

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
