<?php

namespace Kiefernwald\Affair\Model;

/**
 * Event place model
 *
 * @package Kiefernwald\Affair\Model
 */
class EventRegion
{
    /**
     * Title of the place
     *
     * @var string $title
     */
    protected $title;

    /**
     * Id of place
     *
     * @var string $id
     */
    protected $id;

    /**
     * Getter for id
     *
     * @return string Current id
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Setter for id
     *
     * @param string $id New id
     *
     * @return void
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * Getter for title
     *
     * @return string Current title
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Setter for title
     *
     * @param string $title New title
     *
     * @return void
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
}
