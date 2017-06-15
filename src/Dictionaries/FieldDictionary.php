<?php

namespace Honeymustard\FieldFactory\Dictionaries;

/**
 * Dictionary for translations between terms.
 */
class FieldDictionary implements AbstractDictionary
{
    public function getMap()
    {
        return [
            'conds'   => 'conditional_logic',
            'instr'   => 'instructions',
            'default' => 'default_value',
            'upload'  => 'media_upload',
            'types'   => 'post_type',
            'button'  => 'button_label',
            'subs'    => 'sub_fields',
            'the_oc'  => 'other_choice',
            'save_oc' => 'save_other_choice',
        ];
    }
}