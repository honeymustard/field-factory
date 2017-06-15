<?php

namespace Honeymustard\FieldFactory\Utils;

/**
 * Utility class for maps.
 */
class Maps
{
    /**
     * Get a value from a map.
     *
     * @param string $key   Lookup key.
     * @param string[] $map The map to look in.
     *
     * @return mixed
     */
    public static function get($key, $map)
    {
        return isset($map[$key]) ? $map[$key] : '';
    }

    /**
     * Require that a map contains a given key.
     *
     * @param string $key   Lookup key.
     * @param string[] $map The map to look in.
     *
     * @throws Exception If key is missing.
     *
     * @return mixed
     */
    public static function require($key, $map)
    {
        if (isset($map[$key])) {
            return $map[$key];
        }

        throw new \Exception('Required key "' . $key . '" was missing.');
    }
}
