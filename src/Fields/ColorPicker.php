<?php

namespace Honeymustard\FieldFactory\Fields;

/**
 * Color picker field implementation.
 */
class ColorPicker extends AbstractField
{
    /**
     * Construct new field.
     *
     * @param string[] Field arguments.
     */
    public function __construct($args)
    {
        parent::__construct('color_picker', $args);
    }

    /**
     * Get the default arguments.
     *
     * @return string[]
     */
    protected function getFieldArgs()
    {
        return [
            'default' => '#000000',
        ];
    }
}
