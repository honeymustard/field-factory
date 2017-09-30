<?php

namespace Honeymustard\FieldFactory\Fields;

/**
 * Time picker field implementation.
 */
class TimePicker extends AbstractField
{
    /**
     * Construct new field.
     *
     * @param string[] Field arguments.
     */
    public function __construct($args)
    {
        parent::__construct('time_picker', $args);
    }

    /**
     * Get the default arguments.
     *
     * @return string[]
     */
    protected function getFieldArgs()
    {
        return [
            'display' => 'H:i',
            'return'  => 'U',
        ];
    }
}
