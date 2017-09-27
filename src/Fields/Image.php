<?php

namespace Honeymustard\FieldFactory\Fields;

/**
 * Image field implementation.
 */
class Image extends AbstractField
{
    /**
     * Construct new field.
     *
     * @param string[] Field arguments.
     */
    public function __construct($args)
    {
        parent::__construct('image', $args);
    }

    /**
     * Get the default arguments.
     *
     * @return string[]
     */
    protected function getFieldArgs()
    {
        return [
            'return'       => 'array',
            'preview_size' => 'thumbnail',
            'library'      => 'all',
            'min_width'    => '',
            'min_height'   => '',
            'min_size'     => '',
            'max_width'    => '',
            'max_height'   => '',
            'max_size'     => '',
            'mime_types'   => '',
        ];
    }
}
