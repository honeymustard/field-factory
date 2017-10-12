<?php

namespace Honeymustard\FieldFactory\Fields;

/**
 * Google map field implementation.
 */
class GoogleMap extends AbstractField
{
    /**
     * Construct new field.
     *
     * @param string[] $args Field arguments.
     */
    public function __construct($args)
    {
        parent::__construct('google_map', $args);
    }

    /**
     * Get the default arguments.
     *
     * @return string[]
     */
    protected function getFieldArgs()
    {
        return [
            'center_lat' => '59.911491',
            'center_lng' => '10.757933',
            'zoom'       => '',
            'height'     => '',
        ];
    }
}
