<?php

namespace Honeymustard\FieldFactory\Collections;

/**
 * Base class for all lists.
 */
abstract class AbstractList implements \Iterator
{
    private $list = [];
    private $position = 0;

    /**
     * Get the length of the list.
     *
     * @return int
     */
    public function length() {
        return count($this->list);
    }

    /**
     * Reset the iteration.
     *
     * @return void
     */
    public function rewind() {
        $this->position = 0;
    }

    /**
     * Get the current value.
     *
     * @return mixed
     */
    public function current() {
        return $this->list[$this->position];
    }

    /**
     * Get the current index.
     *
     * @return int
     */
    public function key() {
        return $this->position;
    }

    /**
     * Set the next position.
     *
     * @return void
     */
    public function next() {
        ++$this->position;
    }

    /**
     * Determine if current position is valid.
     *
     * @return boolean
     */
    public function valid() {
        return isset($this->list[$this->position]);
    }

    /**
     * Append an item to the list.
     *
     * @param mixed $item
     *
     * @return boolean
     */
    public function push($item) {
        $this->list[] = $item;
    }

    /**
     * Get the inner array structure.
     *
     * @return mixed[]
     */
    public function toArray() {
        return $this->list;
    }
}
