<?php

namespace Honeymustard\FieldFactory\Fields;

/**
 * Wysiwyg field implementation.
 */
class Wysiwyg extends AbstractField
{
    /**
     * Construct new field.
     *
     * @param string[] $args Field arguments.
     */
    public function __construct($args)
    {
        parent::__construct('wysiwyg', $args);
    }

    /**
     * Get the default arguments.
     *
     * @return string[]
     */
    protected function getFieldArgs()
    {
        return [
            'default'  => '',
            'tabs'     => 'all',
            'toolbar'  => 'basic',
            'upload'   => 0,
        ];
    }
}
