<?php

namespace Honeymustard\FieldFactory\Fields;

/**
 * True False field implementation.
 */
class TrueFalse extends AbstractField
{
    /**
     * Construct new field.
     *
     * @param string[] Field arguments.
     */
    public function __construct($args)
    {
        parent::__construct('true_false', $args);
    }

    /**
     * Get the default arguments.
     *
     * @return string[]
     */
    protected function getFieldArgs()
    {
        return [
            'message'  => '',
            'default'  => 0,
        ];
    }
}
