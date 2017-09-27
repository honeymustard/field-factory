<?php

namespace Honeymustard\FieldFactory\Fields;

/**
 * File field implementation.
 */
class File extends AbstractField
{
    /**
     * Construct new field.
     *
     * @param string[] Field arguments.
     */
    public function __construct($args)
    {
        parent::__construct('file', $args);
    }

    /**
     * Get the default arguments.
     *
     * @return string[]
     */
    protected function getFieldArgs()
    {
        return [
            'return'     => 'id',
            'library'    => 'all',
            'min_size'   => '',
            'max_size'   => '',
            'mime_types' => '',
        ];
    }
}
