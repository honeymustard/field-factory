<?php

namespace Honeymustard\FieldFactory\Fields;

/**
 * Email field implementation.
 */
class Email extends AbstractField
{
    /**
     * Construct new field.
     *
     * @param string[] Field arguments.
     */
    public function __construct($args)
    {
        parent::__construct('email', $args);
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
        ];
    }
}
