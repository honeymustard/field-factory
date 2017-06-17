<?php

namespace Honeymustard\FieldFactory\Fields;

/**
 * Text field implementation.
 */
class Text extends AbstractField
{
    /**
     * Construct new field.
     *
     * @param string[] Field arguments.
     */
    public function __construct($args)
    {
        parent::__construct('text', $args);
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
            'maxlength'   => '',
        ];
    }
}
