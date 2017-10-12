<?php

namespace Honeymustard\FieldFactory\Fields;

/**
 * Radio field implementation.
 */
class Radio extends AbstractField
{
    /**
     * Construct new field.
     *
     * @param string[] $args Field arguments.
     */
    public function __construct($args)
    {
        parent::__construct('radio', $args);
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
            'allow_null'  => 0,
            'the_oc'      => 0,
            'save_the_oc' => 0,
            'default'     => '',
            'layout'      => 'horizontal',
            'return'      => 'value',
        ];
    }
}
