<?php

namespace Honeymustard\FieldFactory\Dictionaries;

use Honeymustard\FieldFactory\Interfaces\DictionaryInterface;

/**
 * Dictionary for translations of layout terms.
 */
class LayoutDictionary implements DictionaryInterface
{
    /**
     * Get dictionary values as a map.
     *
     * @return string[]
     */
    public function getMap()
    {
        return [
            'subs'    => 'sub_fields',
            'display' => 'display_format',
        ];
    }
}
