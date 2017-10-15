<?php

namespace Honeymustard\FieldFactory\Dictionaries;

use Honeymustard\FieldFactory\Interfaces\DictionaryInterface;

/**
 * Dictionary for translations of group terms.
 */
class GroupDictionary implements DictionaryInterface
{
    /**
     * Get dictionary values as a map.
     *
     * @return string[]
     */
    public function getMap()
    {
        return [
            'label_pos' => 'label_placement',
            'instr_pos' => 'instruction_placement',
            'order'     => 'menu_order',
            'hide'      => 'hide_on_screen',
            'desc'      => 'description',
        ];
    }
}
