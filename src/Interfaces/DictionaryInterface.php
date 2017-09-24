<?php

namespace Honeymustard\FieldFactory\Interfaces;

/**
 * An interface for Dictionaries.
 */
interface DictionaryInterface
{
    /**
     * Get dictionary values as a map.
     *
     * @return string[]
     */
    public function getMap();
}
