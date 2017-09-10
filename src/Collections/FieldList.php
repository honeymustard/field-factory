<?php

namespace Honeymustard\FieldFactory\Collections;

use Honeymustard\FieldFactory\Fields;

/**
 * Maintains a lists of field objects.
 */
class FieldList extends AbstractList
{
    private $fields = [];

    /**
     * Set the initial list.
     *
     * @param AbstractField[] $fields Initial list of fields.
     */
    public function __construct($fields = [])
    {
        $this->fields = $fields;
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
        $this->fields[] = $field;
    }

    /**
     * Get a field at a given index,
     *
     * @param int $index Index of field.
     *
     * @return AbstractField
     */
    public function indexOf($index)
    {
        if (isset($this->fields[$index])) {
            return $this->fields[$index];
        }

        $message = 'Could not get field at invalid index';
        trigger_error($message, E_USER_ERROR);
    }

    /**
     * Get the list of field objects.
     *
     * @return AbstractField[]
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * Get the length of the list.
     *
     * @return int
     */
    public function length()
    {
        return count($this->getFields());
    }
}
