<?php

namespace Honeymustard\FieldFactory\Fields;

/**
 * Gallery field implementation.
 */
class Gallery extends AbstractField
{
    /**
     * Construct new field.
     *
     * @param string[] $args Field arguments.
     */
    public function __construct($args)
    {
        parent::__construct('gallery', $args);
    }

    /**
     * Get the default arguments.
     *
     * @return string[]
     */
    protected function getFieldArgs()
    {
        return [
            'min'        => '',
            'max'        => '',
            'insert'     => 'append',
            'library'    => 'all',
            'min_width'  => '',
            'min_height' => '',
            'min_size'   => '',
            'max_width'  => '',
            'max_height' => '',
            'max_size'   => '',
            'mime_types' => '',
        ];
    }
}
