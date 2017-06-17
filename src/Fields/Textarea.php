<?php

namespace Honeymustard\FieldFactory\Fields;

/**
 * Textarea field implementation.
 */
class Textarea extends AbstractField
{
    /**
     * Construct new field.
     *
     * @param string[] Field arguments.
     */
    public function __construct($args)
    {
        parent::__construct('textarea', $args);
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
            'maxlength'   => '',
            'rows'        => 4,
            'new_lines'   => 'br',
        ];
    }
}
