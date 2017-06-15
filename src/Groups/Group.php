<?php

namespace Honeymustard\FieldFactory\Groups;

/**
 * A concrete group implementation.
 */
class Group
{
    private $args = [];

    /**
     * Construct a new group.
     *
     * @param string $id     A unique ID.
     * @param string[] $args A map of arguments.
     */
    public function __construct($id, $args)
    {
        $this->args = $args;
        parent::__construct($id);
    }

    /**
     * Get the complete group.
     *
     * @return string[]
     */
    public function getGroup()
    {
        $args = $this->getArgs();

        return parent::getGroup();
    }

    /**
     * Get the list of fields.
     *
     * @return string[]
     */
    public function getFields()
    {
        return [];
    }

    /**
     * Get the arguments map.
     *
     * @return string[]
     */
    public function getArgs()
    {
        return $this->args;
    }
}
