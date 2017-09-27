<?php

namespace Honeymustard\FieldFactory\Fields;

/**
 * Select field implementation.
 */
class Select extends AbstractField
{
    /**
     * Construct new field.
     *
     * @param string[] Field arguments.
     */
    public function __construct($args)
    {
        parent::__construct('select', $args);
    }

    /**
     * Get the default arguments.
     *
     * @return string[]
     */
    protected function getFieldArgs()
    {
        return [
            'choices'     => [],
            'default'     => [],
            'allow_null'  => 0,
            'multiple'    => 0,
            'ui'          => 0,
            'ajax'        => 0,
            'return'      => 'value',
            'placeholder' => '',
        ];
    }
}
