<?php

namespace Honeymustard\FieldFactory\Utils;

/**
 * Utility class for URL's.
 */
class URL
{
    /**
     * Remove pound sign from anchor.
     *
     * @param string $anchor Anchor to be filtered.
     *
     * @return string
     */
    public static function filterAnchor($anchor)
    {
        return str_replace('#', '', $anchor);
    }

    /**
     * Append an anchor to a url.
     *
     * @param string $url    A complete url.
     * @param string $anchor Anchor with optional pound sign.
     *
     * @return string
     */
    public static function appendAnchor($url, $anchor)
    {
        $anchor = self::filterAnchor($anchor);

        if ($anchor) {
            $url = trailingslashit($url).'#'.$anchor;
        }

        return $url;
    }
}
