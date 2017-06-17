<?php

namespace Honeymustard\FieldFactory\Fields;

/**
 * Flexible Content field implementation.
 */
class FlexibleContent extends AbstractField
{
    /**
     * Construct new field.
     *
     * @param string[] Field arguments.
     */
    public function __construct($args)
    {
        parent::__construct('flexible_content', $args);
    }

    /**
     * Get the default arguments.
     *
     * @return string[]
     */
    protected function getFieldArgs()
    {
        return [
            'button'  => 'Add layout',
            'min'     => '',
            'max'     => '',
            'layouts' => [],
        ];
    }
}
