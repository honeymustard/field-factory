<?php

namespace Honeymustard\FieldFactory\Utils;

/**
 * Controls package paths.
 */
class Paths
{
    /**
     * Get the absolute path to a resource.
     *
     * @param string $name The name of a resource.
     *
     * @return string
     */
    public static function resource($name)
    {
        return dirname(dirname(__DIR__)).'/resources/'.$name;
    }
}
