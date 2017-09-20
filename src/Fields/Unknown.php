<?php

namespace Honeymustard\FieldFactory\Fields;

use Honeymustard\FieldFactory\Utils\Maps;

/**
 * A generic field implementation for unknown types.
 */
class Unknown extends AbstractField
{
    /**
     * Construct new field.
     *
     * @param string[] Field arguments.
     */
    public function __construct($args)
    {
        parent::__construct(Maps::get('type', $args, ''), $args);
    }
}
