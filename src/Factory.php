<?php

namespace Honeymustard\FieldFactory;

use Honeymustard\FieldFactory\Fields;
use Honeymustard\FieldFactory\Collections;

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
        $this->list = new Collections\FieldList();
    }

    /**
     * Get the field list instance.
     *
     * @return FieldList
     */
    public function getList()
    {
        return $this->list;
    }

    /**
     * Add a custom field type.
     *
     * @param AbstractField $field A valid field type.
     *
     * @return AbstractField
     */
    public function append(Fields\AbstractField $field)
    {
        return $this->getList()->append($field);
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
     * @return AbstractField
     */
    public function tab($args)
    {
        return $this->append(new Fields\Tab($args));
    }

    /**
     * Generate a new message field.
     *
     * @return AbstractField
     */
    public function message($args)
    {
        return $this->append(new Fields\Message($args));
    }

    /**
     * Generate a new repeater field.
     *
     * @return AbstractField
     */
    public function repeater($args)
    {
        return $this->append(new Fields\Repeater($args));
    }

    /**
     * Generate a new image field.
     *
     * @return AbstractField
     */
    public function image($args)
    {
        return $this->append(new Fields\Image($args));
    }

    /**
     * Generate a new text field.
     *
     * @return AbstractField
     */
    public function text($args)
    {
        return $this->append(new Fields\Text($args));
    }

    /**
     * Generate a new textarea field.
     *
     * @return AbstractField
     */
    public function textarea($args)
    {
        return $this->append(new Fields\Textarea($args));
    }

    /**
     * Generate a new wysiwyg field.
     *
     * @return AbstractField
     */
    public function wysiwyg($args)
    {
        return $this->append(new Fields\Wysiwyg($args));
    }

    /**
     * Generate a new radio buttons field.
     *
     * @return AbstractField
     */
    public function radio($args)
    {
        return $this->append(new Fields\Radio($args));
    }

    /**
     * Generate a new url field.
     *
     * @return AbstractField
     */
    public function url($args)
    {
        return $this->append(new Fields\URL($args));
    }

    /**
     * Generate a new post object field.
     *
     * @return AbstractField
     */
    public function postObject($args)
    {
        return $this->append(new Fields\PostObject($args));
    }

    /**
     * Generate a new select field.
     *
     * @return AbstractField
     */
    public function select($args)
    {
        return $this->append(new Fields\Select($args));
    }

    /**
     * Generate a new checkbox field.
     *
     * @return AbstractField
     */
    public function checkbox($args)
    {
        return $this->append(new Fields\Checkbox($args));
    }

    /**
     * Generate a new e-mail field.
     *
     * @return AbstractField
     */
    public function email($args)
    {
        return $this->append(new Fields\Email($args));
    }

    /**
     * Generate a new flexible content field.
     *
     * @return AbstractField
     */
    public function flexibleContent($args)
    {
        return $this->append(new Fields\FlexibleContent($args));
    }

    /**
     * Generate a new relationship field.
     *
     * @return AbstractField
     */
    public function relationship($args)
    {
        return $this->append(new Fields\Relationship($args));
    }

    /**
     * Generate a new file field.
     *
     * @return AbstractField
     */
    public function file($args)
    {
        return $this->append(new Fields\File($args));
    }

    /**
     * Generate a new oembed field.
     *
     * @return AbstractField
     */
    public function oembed($args)
    {
        return $this->append(new Fields\Oembed($args));
    }

    /**
     * Generate a new boolean field.
     *
     * @return AbstractField
     */
    public function trueFalse($args)
    {
        return $this->append(new Fields\TrueFalse($args));
    }

    /**
     * Generate a new color picker field.
     *
     * @return AbstractField
     */
    public function colorPicker($args)
    {
        return $this->append(new Fields\ColorPicker($args));
    }

    /**
     * Generate a new date & time picker field.
     *
     * @return AbstractField
     */
    public function dateTimePicker($args)
    {
        return $this->append(new Fields\DateTimePicker($args));
    }

    /**
     * Generate a new user selection field.
     *
     * @return AbstractField
     */
    public function user($args)
    {
        return $this->append(new Fields\User($args));
    }

    /**
     * Generate a new number field.
     *
     * @return AbstractField
     */
    public function number($args)
    {
        return $this->append(new Fields\Number($args));
    }

    /**
     * Generate a new google map field.
     *
     * @return AbstractField
     */
    public function googleMap($args)
    {
        return $this->append(new Fields\GoogleMap($args));
    }
}
