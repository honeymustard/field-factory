<?php

namespace Honeymustard\FieldFactory\Fields;

/**
 * Post-object field implementation.
 */
class PostObject extends AbstractField
{
    /**
     * Construct new field.
     *
     * @param string[] Field arguments.
     */
    public function __construct($args)
    {
        parent::__construct('post_object', $args);
    }

    /**
     * Get the default arguments.
     *
     * @return string[]
     */
    protected function getFieldArgs()
    {
        return [
            'post_type'  => [],
            'taxonomy'   => [],
            'allow_null' => 0,
            'multiple'   => 0,
            'return'     => 'id',
            'ui'         => 1,
        ];
    }
}
