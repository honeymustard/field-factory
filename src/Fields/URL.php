<?php

namespace Honeymustard\FieldFactory\Fields;

/**
 * URL field implementation.
 */
class URL extends AbstractField
{
    /**
     * Construct new field.
     *
     * @param string[] Field arguments.
     */
    public function __construct($args)
    {
        parent::__construct('url', $args);
    }

    /**
     * Get the default arguments.
     *
     * @return string[]
     */
    protected function getFieldArgs()
    {
        return [
            'choices'       => [],
            'allow_null'    => 0,
            'the_oc'        => 0,
            'save_the_oc'   => 0,
            'default'       => '',
            'layout'        => 'horizontal',
            'return_format' => 'value',
            'default'       => '',
            'placeholder'   => '',
        ];
    }
}
