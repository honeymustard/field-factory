<?php

namespace Honeymustard\FieldFactory\Collections;

/**
 * Base class for all lists.
 */
abstract class AbstractList
{
    /**
     * Get the length of the list.
     *
     * @return int
     */
    abstract public function length();
}
