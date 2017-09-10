<?php

namespace Honeymustard\FieldFactory\Collections;

use Honeymustard\FieldFactory\Fields;

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
            $this->append($field);
        }
    }

    /**
     * Add a new field to the list.
     *
     * @param AbstractField $field A field instance.
     *
     * @return void
     */
    public function append(Fields\AbstractField $field)
    {
        $this->push($field);
    }

    /**
     * Get the list of field objects.
     *
     * @return AbstractField[]
     */
    public function getFields()
    {
        return $this->getList();
    }
}
