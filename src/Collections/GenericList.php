<?php

namespace Honeymustard\FieldFactory\Collections;

/**
 * A generic list implementation.
 */
final class GenericList extends AbstractList
{
    /**
     * Construct a new list.
     *
     * @param mixed[] $items An initial list of items.
     */
    public function __construct($items = [])
    {
        foreach ($items as $item) {
            $this->push($item);
        }
    }
}
