<?php

namespace Honeymustard\FieldFactory\Fields;

/**
 * Date picker field implementation.
 */
class DatePicker extends AbstractField
{
    /**
     * Construct new field.
     *
     * @param string[] Field arguments.
     */
    public function __construct($args)
    {
        parent::__construct('date_picker', $args);
    }

    /**
     * Get the default arguments.
     *
     * @return string[]
     */
    protected function getFieldArgs()
    {
        return [
            'display'   => 'd/m/Y H:i',
            'return'    => 'U',
            'first_day' => 1,
        ];
    }
}
