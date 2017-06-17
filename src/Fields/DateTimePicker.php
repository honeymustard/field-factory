<?php

namespace Honeymustard\FieldFactory\Fields;

/**
 * Date and time picker field implementation.
 */
class DateTimePicker extends AbstractField
{
    /**
     * Construct new field.
     *
     * @param string[] Field arguments.
     */
    public function __construct($args)
    {
        parent::__construct('date_time_picker', $args);
    }

    /**
     * Get the default arguments.
     *
     * @return string[]
     */
    protected function getFieldArgs()
    {
        return [
            'display_format' => 'd/m/Y H:i',
            'return_format'  => 'U',
            'first_day'      => 1,
        ];
    }
}
