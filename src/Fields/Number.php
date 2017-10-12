<?php

namespace Honeymustard\FieldFactory\Fields;

/**
 * Number field implementation.
 */
class Number extends AbstractField
{
    /**
     * Construct new field.
     *
     * @param string[] $args Field arguments.
     */
    public function __construct($args)
    {
        parent::__construct('number', $args);
    }

    /**
     * Get the default arguments.
     *
     * @return string[]
     */
    protected function getFieldArgs()
    {
        return [
            'default'     => '',
            'placeholder' => '',
            'prepend'     => '',
            'append'      => '',
            'min'         => '',
            'max'         => '',
            'step'        => '',
        ];
    }
}
