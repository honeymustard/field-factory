<?php

namespace Honeymustard\FieldFactory\Fields;

/**
 * Password field implementation.
 */
class Password extends AbstractField
{
    /**
     * Construct new field.
     *
     * @param string[] $args Field arguments.
     */
    public function __construct($args)
    {
        parent::__construct('password', $args);
    }

    /**
     * Get the default arguments.
     *
     * @return string[]
     */
    protected function getFieldArgs()
    {
        return [
            'placeholder' => '',
            'prepend'     => '',
            'append'      => '',
        ];
    }
}
