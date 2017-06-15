<?php

namespace Honeymustard\FieldFactory\Fields;

/**
 * Tab field implementation.
 */
class Tab extends AbstractField
{
    /**
     * Construct new field.
     *
     * @param string[] Field arguments.
     */
    public function __construct($args)
    {
        parent::__construct('tab', $args);
    }

    /**
     * Get the default arguments.
     *
     * @return string[]
     */
    protected function getFieldArgs()
    {
        return [
            'endpoint'  => 0,
        ];
    }
}
