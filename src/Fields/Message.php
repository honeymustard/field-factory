<?php

namespace Honeymustard\FieldFactory\Fields;

/**
 * Message field implementation.
 */
class Message extends AbstractField
{
    /**
     * Construct new field.
     *
     * @param string[] Field arguments.
     */
    public function __construct($args)
    {
        parent::__construct('message', $args);
    }

    /**
     * Get the default arguments.
     *
     * @return string[]
     */
    protected function getFieldArgs()
    {
        return [
            'message'   => '',
            'new_lines' => 'br',
            'esc_html'  => 0,
        ];
    }
}
