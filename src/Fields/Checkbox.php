<?php

namespace Honeymustard\FieldFactory\Fields;

/**
 * Checkbox field implementation.
 */
class Checkbox extends AbstractField
{
    /**
     * Construct new field.
     *
     * @param string[] Field arguments.
     */
    public function __construct($args)
    {
        parent::__construct('checkbox', $args);
    }

    /**
     * Get the default arguments.
     *
     * @return string[]
     */
    protected function getFieldArgs()
    {
        return [
            'choices' => [],
            'default' => '',
            'layout'  => 'horizontal',
            'toggle'  => 1,
            'return'  => 'value',
        ];
    }
}
