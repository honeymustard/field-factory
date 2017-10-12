<?php

namespace Honeymustard\FieldFactory\Utils;

/**
 * Generic conversion methods.
 */
final class Converter
{
    /**
     * Recursively apply toArray on a list.
     *
     * @param string|object[] $list A list.
     *
     * @return string[]
     */
    public static function toArray($list)
    {
        $temp = [];

        if (!empty($list)) {
            foreach ($list as $k => $v) {
                if (is_array($v)) {
                    $temp[$k] = self::toArray($v);
                } elseif (is_object($v)) {
                    $temp[$k] = self::toArray($v->toArray());
                } else {
                    $temp[$k] = $v;
                }
            }
        }

        return $temp;
    }
}
