<?php

namespace Honeymustard\FieldFactory\Fields;

/**
 * Relationship field implementation.
 */
class Relationship extends AbstractField
{
    /**
     * Construct new field.
     *
     * @param string[] $args Field arguments.
     */
    public function __construct($args)
    {
        parent::__construct('relationship', $args);
    }

    /**
     * Get the default arguments.
     *
     * @return string[]
     */
    protected function getFieldArgs()
    {
        return [
            'post_type' => [],
            'taxonomy'  => [],
            'elements'  => '',
            'min'       => '',
            'max'       => '',
            'return'    => 'id',
            'filters'   => [
                0 => 'search',
                1 => 'post_type',
                2 => 'taxonomy',
            ],
        ];
    }
}
