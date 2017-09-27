<?php

namespace Honeymustard\FieldFactory\Fields;

/**
 * Taxonomy field implementation.
 */
class Taxonomy extends AbstractField
{
    /**
     * Construct new field.
     *
     * @param string[] Field arguments.
     */
    public function __construct($args)
    {
        parent::__construct('taxonomy', $args);
    }

    /**
     * Get the default arguments.
     *
     * @return string[]
     */
    protected function getFieldArgs()
    {
        return [
            'taxonomy'   => 'category',
            'field_type' => 'multi_select',
            'allow_null' => 1,
            'add_term'   => 0,
            'save_terms' => 0,
            'load_terms' => 0,
            'return'     => 'id',
            'multiple'   => 0,
        ];
    }
}
