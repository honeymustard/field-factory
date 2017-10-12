<?php

namespace Honeymustard\FieldFactory\Utils;

/**
 * Utility class for images.
 */
class Image
{
    /**
     * Get image from array.
     *
     * @param string[] $image Map of image data.
     * @param string   $size  Optional name of image size.
     *
     * @return string the complete image url.
     */
    public static function getImage($image, $size = '')
    {
        if (!empty($size) && isset($image['sizes'][$size])) {
            return $image['sizes'][$size];
        }

        return isset($image['url']) ? $image['url'] : '';
    }
}
