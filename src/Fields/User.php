<?php

namespace Honeymustard\FieldFactory\Fields;

/**
 * User field implementation.
 */
class User extends AbstractField
{
    /**
     * Construct new field.
     *
     * @param string[] Field arguments.
     */
    public function __construct($args)
    {
        parent::__construct('user', $args);
    }

    /**
     * Get the default arguments.
     *
     * @return string[]
     */
    protected function getFieldArgs()
    {
        return [
            'role'       => [],
            'allow_null' => 1,
            'multiple'   => 0,
        ];
    }
}
