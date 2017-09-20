<?php

namespace Honeymustard\FieldFactory\Collections;

use Honeymustard\FieldFactory\Fields\AbstractField;
use Honeymustard\FieldFactory\Interfaces\ArrayableInterface;

/**
 * Maintains a lists of field objects.
 */
class FieldList extends AbstractList
{
    /**
     * Set the initial list.
     *
     * @param AbstractField[] $fields Initial list of fields.
     */
    public function __construct($fields = [])
    {
        foreach ($fields as $field) {
            $this->push($field);
        }
    }

    /**
     * Add a new field to the list.
     *
     * @param Arrayable $field A field instance.
     *
     * @return void
     */
    public function push($item)
    {
        if (!$item instanceof ArrayableInterface) {
            throw new \Exception('Could not push non Arrayable item to array list');
        }

        parent::push($item);
    }

    /**
     * Get the list of field objects.
     *
     * @return AbstractField[]
     */
    public function getFields()
    {
        return $this->toArray();
    }
}
