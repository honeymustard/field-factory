<?php

namespace Honeymustard\FieldFactory;

use Honeymustard\FieldFactory\Fields;
use Honeymustard\FieldFactory\Fields\AbstractField;
use Honeymustard\FieldFactory\Collections\FieldList;
use Honeymustard\FieldFactory\Utils\Converter;

/**
 * Field generator class for all field types.
 */
class Factory
{
    private $list = null;

    /**
     * Construct a new factory.
     */
    public function __construct()
    {
        $this->list = new FieldList();
    }

    /**
     * Convert the fields list to an array.
     *
     * @return string[]
     */
    public function toArray()
    {
        return Converter::toArray($this->getFields());
    }

    /**
     * Get the list of fields.
     *
     * @return AbstractField[]
     */
    public function getFields()
    {
        return $this->list->getList();
    }

    /**
     * Get the field list.
     *
     * @return FieldList
     */
    protected function getList()
    {
        return $this->list;
    }

    /**
     * Add a custom field type.
     *
     * @param AbstractField $field A valid field type.
     *
     * @return Factory
     */
    public function append(AbstractField $field)
    {
        $this->getList()->append($field);
        return $this;
    }

    /**
     * Get the field list length.
     *
     * @return int
     */
    public function length()
    {
        return $this->getList()->length();
    }

    /**
     * Generate a new tab field.
     *
     * @return Factory
     */
    public function tab($args)
    {
        return $this->append(new Fields\Tab($args));
    }

    /**
     * Generate a new message field.
     *
     * @return Factory
     */
    public function message($args)
    {
        return $this->append(new Fields\Message($args));
    }

    /**
     * Generate a new repeater field.
     *
     * @return Factory
     */
    public function repeater($args)
    {
        return $this->append(new Fields\Repeater($args));
    }

    /**
     * Generate a new image field.
     *
     * @return Factory
     */
    public function image($args)
    {
        return $this->append(new Fields\Image($args));
    }

    /**
     * Generate a new text field.
     *
     * @return Factory
     */
    public function text($args)
    {
        return $this->append(new Fields\Text($args));
    }

    /**
     * Generate a new textarea field.
     *
     * @return Factory
     */
    public function textarea($args)
    {
        return $this->append(new Fields\Textarea($args));
    }

    /**
     * Generate a new wysiwyg field.
     *
     * @return Factory
     */
    public function wysiwyg($args)
    {
        return $this->append(new Fields\Wysiwyg($args));
    }

    /**
     * Generate a new radio buttons field.
     *
     * @return Factory
     */
    public function radio($args)
    {
        return $this->append(new Fields\Radio($args));
    }

    /**
     * Generate a new url field.
     *
     * @return Factory
     */
    public function url($args)
    {
        return $this->append(new Fields\URL($args));
    }

    /**
     * Generate a new post object field.
     *
     * @return Factory
     */
    public function postObject($args)
    {
        return $this->append(new Fields\PostObject($args));
    }

    /**
     * Generate a new select field.
     *
     * @return Factory
     */
    public function select($args)
    {
        return $this->append(new Fields\Select($args));
    }

    /**
     * Generate a new checkbox field.
     *
     * @return Factory
     */
    public function checkbox($args)
    {
        return $this->append(new Fields\Checkbox($args));
    }

    /**
     * Generate a new e-mail field.
     *
     * @return Factory
     */
    public function email($args)
    {
        return $this->append(new Fields\Email($args));
    }

    /**
     * Generate a new flexible content field.
     *
     * @return Factory
     */
    public function flexibleContent($args)
    {
        return $this->append(new Fields\FlexibleContent($args));
    }

    /**
     * Generate a new relationship field.
     *
     * @return Factory
     */
    public function relationship($args)
    {
        return $this->append(new Fields\Relationship($args));
    }

    /**
     * Generate a new file field.
     *
     * @return Factory
     */
    public function file($args)
    {
        return $this->append(new Fields\File($args));
    }

    /**
     * Generate a new oembed field.
     *
     * @return Factory
     */
    public function oembed($args)
    {
        return $this->append(new Fields\Oembed($args));
    }

    /**
     * Generate a new boolean field.
     *
     * @return Factory
     */
    public function trueFalse($args)
    {
        return $this->append(new Fields\TrueFalse($args));
    }

    /**
     * Generate a new color picker field.
     *
     * @return Factory
     */
    public function colorPicker($args)
    {
        return $this->append(new Fields\ColorPicker($args));
    }

    /**
     * Generate a new date & time picker field.
     *
     * @return Factory
     */
    public function dateTimePicker($args)
    {
        return $this->append(new Fields\DateTimePicker($args));
    }

    /**
     * Generate a new user selection field.
     *
     * @return Factory
     */
    public function user($args)
    {
        return $this->append(new Fields\User($args));
    }

    /**
     * Generate a new number field.
     *
     * @return Factory
     */
    public function number($args)
    {
        return $this->append(new Fields\Number($args));
    }

    /**
     * Generate a new google map field.
     *
     * @return Factory
     */
    public function googleMap($args)
    {
        return $this->append(new Fields\GoogleMap($args));
    }
}
