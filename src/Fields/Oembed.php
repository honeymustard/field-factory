<?php

namespace Honeymustard\FieldFactory\Fields;

/**
 * Oembed field implementation.
 */
class Oembed extends AbstractField
{
    /**
     * Construct new field.
     *
     * @param string[] $args Field arguments.
     */
    public function __construct($args)
    {
        parent::__construct('oembed', $args);
    }

    /**
     * Get the default arguments.
     *
     * @return string[]
     */
    protected function getFieldArgs()
    {
        return [
            'width'  => '',
            'height' => '',
        ];
    }
}
