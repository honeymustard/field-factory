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
     * @param mixed $none   Optional empty value.
     *
     * @return mixed
     */
    public static function get($key, $map, $none = '')
    {
        return isset($map[$key]) ? $map[$key] : $none;
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
        if (self::get($key, $map, false)) {
            return $map[$key];
        }

        throw new \Exception('Required key "' . $key . '" was missing or empty.');
    }

    /**
     * Determine if a map entry is empty.
     *
     * @param string $key   Lookup key.
     * @param string[] $map The map to look in.
     *
     * @return mixed
     */
    public static function empty($key, $map)
    {
        return self::get($key, $map) === '';
    }

    /**
     * Determine if a map entry is set and true.
     *
     * @param string $key   Lookup key.
     * @param string[] $map The map to look in.
     *
     * @return boolean
     */
    public static function true($key, $map)
    {
        return self::get($key, $map, false) === true;
    }
}
