<?php

namespace Honeymustard\FieldFactory\Interfaces;

/**
 * An interface for objects that give data as an array.
 */
interface ArrayableInterface
{
    /**
     * Convert object to an array.
     *
     * @return string[]
     */
    public function toArray();
}
