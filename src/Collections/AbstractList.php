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
    public function length()
    {
        return count($this->list);
    }

    /**
     * Reset the iteration.
     *
     * @return void
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * Get the current value.
     *
     * @return mixed
     */
    public function current()
    {
        return $this->list[$this->position];
    }

    /**
     * Get the current index.
     *
     * @return int
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * Set the next position.
     *
     * @return void
     */
    public function next()
    {
        ++$this->position;
    }

    /**
     * Determine if current position is valid.
     *
     * @return boolean
     */
    public function valid()
    {
        return isset($this->list[$this->position]);
    }

    /**
     * Append an item to the list.
     *
     * @param mixed $item
     *
     * @return boolean
     */
    public function push($item)
    {
        $this->list[] = $item;
    }

    /**
     * Set an item at a given index.
     *
     * @param mixed $item
     * @param int $index
     *
     * @return void
     */
    public function setItem($item, $index)
    {
        if (!$this->hasIndex($index)) {
            $message = 'Could not set item at given index';
            throw new \Exception($message);
        }

        $this->list[$index] = $item;
    }

    /**
     * Get an item at a given index.
     *
     * @param int $index
     *
     * @return mixed
     */
    public function getItem($index)
    {
        if ($this->hasIndex($index)) {
            return $this->list[$index];
        }

        $message = 'Could not get item at given index';
        throw new \Exception($message);
    }

    /**
     * Determine if an index is valid.
     *
     * @param int $index
     *
     * @return boolean
     */
    public function hasIndex($index)
    {
        return $index >= 0 && $index < $this->length();
    }

    /**
     * Get the list structure.
     *
     * @return mixed[]
     */
    public function getList()
    {
        return $this->list;
    }
}
