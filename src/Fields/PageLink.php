<?php

namespace Honeymustard\FieldFactory\Fields;

/**
 * Page link field implementation.
 */
class PageLink extends AbstractField
{
    /**
     * Construct new field.
     *
     * @param string[] $args Field arguments.
     */
    public function __construct($args)
    {
        parent::__construct('page_link', $args);
    }

    /**
     * Get the default arguments.
     *
     * @return string[]
     */
    protected function getFieldArgs()
    {
        return [
            'post_type'      => [],
            'taxonomy'       => [],
            'allow_null'     => 0,
            'allow_archives' => 1,
            'multiple'       => 0,
        ];
    }
}
