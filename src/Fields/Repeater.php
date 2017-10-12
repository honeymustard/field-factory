<?php

namespace Honeymustard\FieldFactory\Fields;

/**
 * Repeater field implementation.
 */
class Repeater extends AbstractField
{
    /**
     * Construct new field.
     *
     * @param string[] $args Field arguments.
     */
    public function __construct($args)
    {
        parent::__construct('repeater', $args);
    }

    /**
     * Get the default arguments.
     *
     * @return string[]
     */
    protected function getFieldArgs()
    {
        return [
            'collapsed' => '',
            'min'       => '',
            'max'       => '',
            'layout'    => 'block',
            'button'    => 'Add',
            'subs'      => [],
        ];
    }
}
