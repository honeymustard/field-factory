<?php

namespace Honeymustard\FieldFactory\Dictionaries;

/**
 * Generic dictionary description.
 */
abstract class AbstractDictionary
{
    /**
     * Get dictionary values as a map.
     *
     * @return string[]
     */
    abstract public function getMap();
}
