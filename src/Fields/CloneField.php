<?php

namespace Honeymustard\FieldFactory\Fields;

/**
 * Clone field implementation.
 */
class CloneField extends AbstractField
{
    /**
     * Construct new field.
     *
     * @param string[] Field arguments.
     */
    public function __construct($args)
    {
        parent::__construct('clone', $args);
    }

    /**
     * Get the default arguments.
     *
     * @return string[]
     */
    protected function getFieldArgs()
    {
        return [
            'clone'        => [],
            'display'      => 'seamless',
            'layout'       => 'block',
            'prefix_label' => 0,
            'prefix_name'  => 0,
        ];
    }
}
