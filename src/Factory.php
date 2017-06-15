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
     * Get the field list length.
     *
     * @return int
     */
    public function length()
    {
        return count($this->getList());
    }

    /**
     * Add a custom field type.
     *
     * @param AbstractField $field A valid field type.
     *
     * @return void
     */
    public function custom(Fields\AbstractField $field)
    {
        return $this->getList()->append($field);
    }

    /**
     * Generate a new tab field.
     *
     * @return AbstractField
     */
    public function tab($args)
    {
        return $this->getList()->append(new Fields\Tab($args));
    }

    /**
     * Generate a new message field.
     */
    public function message($args)
    {
        $field = [
            'key'       => '',
            'label'     => '',
            'name'      => '',
            'type'      => 'message',
            'instr'     => '',
            'required'  => 0,
            'conds'     => 0,
            'wrapper'   => $this->getWrapper(),
            'message'   => '',
            'new_lines' => 'br',
            'esc_html'  => 0,
        ];

        return $this->parseField($field, $args);
    }

    /**
     * Generate a new repeater field.
     */
    public function repeater($args)
    {
        $field = [
            'key'          => '',
            'label'        => '',
            'name'         => '',
            'type'         => 'repeater',
            'instr'        => '',
            'required'     => 0,
            'conds'        => 0,
            'wrapper'      => $this->getWrapper(),
            'collapsed'    => '',
            'min'          => '',
            'max'          => '',
            'layout'       => 'block',
            'button_label' => 'Add',
            'sub_fields'   => [],
        ];

        $field = $this->parseField($field, $args);

        if (is_object($field['sub_fields'])) {
            throw new \Exception('Subfields must contain an array.');
        }

        return $field;
    }

    /**
     * Generate a new image field.
     */
    public function image($args)
    {
        $field = [
            'key'           => '',
            'label'         => '',
            'name'          => '',
            'type'          => 'image',
            'instr'         => '',
            'required'      => 0,
            'conds'         => 0,
            'wrapper'       => $this->getWrapper(),
            'return_format' => 'array',
            'preview_size'  => 'thumbnail',
            'library'       => 'all',
            'min_width'     => '',
            'min_height'    => '',
            'min_size'      => '',
            'max_width'     => '',
            'max_height'    => '',
            'max_size'      => '',
            'mime_types'    => '',
        ];

        return $this->parseField($field, $args);
    }

    /**
     * Generate a new text field.
     */
    public function text($args)
    {
        $field = [
            'key'         => '',
            'label'       => '',
            'name'        => '',
            'type'        => 'text',
            'instr'       => '',
            'required'    => 0,
            'conds'       => 0,
            'wrapper'     => $this->getWrapper(),
            'default'     => '',
            'placeholder' => '',
            'prepend'     => '',
            'append'      => '',
            'maxlength'   => '',
        ];

        return $this->parseField($field, $args);
    }

    /**
     * Generate a new textarea field.
     */
    public function textarea($args)
    {
        $field = [
            'key'         => '',
            'label'       => '',
            'name'        => '',
            'type'        => 'textarea',
            'instr'       => '',
            'required'    => 0,
            'conds'       => 0,
            'wrapper'     => $this->getWrapper(),
            'default'     => '',
            'placeholder' => '',
            'maxlength'   => '',
            'rows'        => 4,
            'new_lines'   => 'br',
        ];

        return $this->parseField($field, $args);
    }

    /**
     * Generate a new wysiwyg field.
     */
    public function wysiwyg($args)
    {
        $field = [
            'key'      => '',
            'label'    => '',
            'name'     => '',
            'type'     => 'wysiwyg',
            'instr'    => '',
            'required' => 0,
            'conds'    => 0,
            'wrapper'  => $this->getWrapper(),
            'default'  => '',
            'tabs'     => 'all',
            'toolbar'  => 'basic',
            'upload'   => 0,
        ];

        return $this->parseField($field, $args);
    }

    /**
     * Generate a new radio buttons field.
     */
    public function radio($args)
    {
        $field = [
            'key'           => '',
            'label'         => '',
            'name'          => '',
            'type'          => 'radio',
            'instr'         => '',
            'required'      => 0,
            'conds'         => 0,
            'wrapper'       => $this->getWrapper(),
            'choices'       => [],
            'allow_null'    => 0,
            'the_oc'        => 0,
            'save_the_oc'   => 0,
            'default'       => '',
            'layout'        => 'horizontal',
            'return_format' => 'value',
        ];

        return $this->parseField($field, $args);
    }

    /**
     * Generate a new url field.
     */
    public function url($args)
    {
        $field = [
            'key'         => '',
            'label'       => '',
            'name'        => '',
            'type'        => 'url',
            'instr'       => '',
            'required'    => 0,
            'conds'       => 0,
            'wrapper'     => $this->getWrapper(),
            'default'     => '',
            'placeholder' => '',
        ];

        return $this->parseField($field, $args);
    }

    /**
     * Generate a new post object field.
     */
    public function postObject($args)
    {
        $field = [
            'key'           => '',
            'label'         => '',
            'name'          => '',
            'type'          => 'post_object',
            'instr'         => '',
            'required'      => 0,
            'conds'         => 0,
            'wrapper'       => $this->getWrapper(),
            'post_type'     => [],
            'taxonomy'      => [],
            'allow_null'    => 0,
            'multiple'      => 0,
            'return_format' => 'id',
            'ui'            => 1,
        ];

        return $this->parseField($field, $args);
    }

    /**
     * Generate a new select field.
     */
    public function select($args)
    {
        $field = [
            'key'           => '',
            'label'         => '',
            'name'          => '',
            'type'          => 'select',
            'instr'         => '',
            'required'      => 0,
            'conds'         => 0,
            'wrapper'       => $this->getWrapper(),
            'choices'       => [],
            'default'       => [],
            'allow_null'    => 0,
            'multiple'      => 0,
            'ui'            => 0,
            'ajax'          => 0,
            'return_format' => 'value',
            'placeholder'   => '',
        ];

        return $this->parseField($field, $args);
    }

    /**
     * Generate a new checkbox field.
     */
    public function checkbox($args)
    {
        $field = [
            'key'           => '',
            'label'         => '',
            'name'          => '',
            'type'          => 'checkbox',
            'instr'         => '',
            'required'      => 0,
            'conds'         => 0,
            'wrapper'       => $this->getWrapper(),
            'choices'       => [],
            'default'       => '',
            'layout'        => 'horizontal',
            'toggle'        => 1,
            'return_format' => 'value',
        ];

        return $this->parseField($field, $args);
    }

    /**
     * Generate a new e-mail field.
     */
    public function email($args)
    {
        $field = [
            'key'         => '',
            'label'       => '',
            'name'        => '',
            'type'        => 'email',
            'instr'       => '',
            'required'    => 0,
            'conds'       => 0,
            'wrapper'     => $this->getWrapper(),
            'default'     => '',
            'placeholder' => '',
            'prepend'     => '',
            'append'      => '',
        ];

        return $this->parseField($field, $args);
    }

    /**
     * Generate a new flexible content field.
     */
    public function flexibleContent($args)
    {
        $field = [
            'key'          => '',
            'label'        => '',
            'name'         => '',
            'type'         => 'flexible_content',
            'instr'        => '',
            'required'     => 0,
            'conds'        => 0,
            'wrapper'      => $this->getWrapper(),
            'button_label' => 'Add layout',
            'min'          => '',
            'max'          => '',
            'layouts'      => [],
        ];

        return $this->parseField($field, $args);
    }

    /**
     * Generate a new relationship field.
     */
    public function relationship($args)
    {
        $field = [
            'key'           => '',
            'label'         => '',
            'name'          => '',
            'type'          => 'relationship',
            'instr'         => '',
            'required'      => 0,
            'conds'         => 0,
            'wrapper'       => $this->getWrapper(),
            'post_type'     => [],
            'taxonomy'      => [],
            'elements'      => '',
            'min'           => '',
            'max'           => '',
            'return_format' => 'id',
            'filters'       => [
                0 => 'search',
                1 => 'post_type',
                2 => 'taxonomy',
            ],
        ];

        return $this->parseField($field, $args);
    }

    /**
     * Generate a new file field.
     */
    public function file($args)
    {
        $field = [
            'key'           => '',
            'label'         => '',
            'name'          => '',
            'type'          => 'file',
            'instr'         => '',
            'required'      => 0,
            'conds'         => 0,
            'wrapper'       => $this->getWrapper(),
            'return_format' => 'id',
            'library'       => 'all',
            'min_size'      => '',
            'max_size'      => '',
            'mime_types'    => '',
        ];

        return $this->parseField($field, $args);
    }

    /**
     * Generate a new oembed field.
     */
    public function oembed($args)
    {
        $field = [
            'key'      => '',
            'label'    => '',
            'name'     => '',
            'type'     => 'oembed',
            'instr'    => '',
            'required' => 0,
            'conds'    => 0,
            'wrapper'  => $this->getWrapper(),
            'width'    => '',
            'height'   => '',
        ];

        return $this->parseField($field, $args);
    }

    /**
     * Generate a new boolean field.
     */
    public function trueFalse($args)
    {
        $field = [
            'key'      => '',
            'label'    => '',
            'name'     => '',
            'type'     => 'true_false',
            'instr'    => '',
            'required' => 0,
            'conds'    => 0,
            'wrapper'  => $this->getWrapper(),
            'message'  => '',
            'default'  => 0,
        ];

        return $this->parseField($field, $args);
    }

    /**
     * Generate a new color picker field.
     */
    public function colorPicker($args)
    {
        $field = [
            'key'      => '',
            'label'    => '',
            'name'     => '',
            'type'     => 'color_picker',
            'instr'    => '',
            'required' => 0,
            'conds'    => 0,
            'wrapper'  => $this->getWrapper(),
            'default'  => '#000000',
        ];

        return $this->parseField($field, $args);
    }

    /**
     * Generate a new date & time picker field.
     */
    public function dateTime($args)
    {
        $field = [
            'key'            => '',
            'label'          => '',
            'name'           => '',
            'type'           => 'date_time_picker',
            'instr'          => '',
            'required'       => 0,
            'conds'          => 0,
            'wrapper'        => $this->getWrapper(),
            'display_format' => 'd/m/Y H:i',
            'return_format'  => 'U',
            'first_day'      => 1,
        ];

        return $this->parseField($field, $args);
    }

    /**
     * Generate a new user selection field.
     */
    public function user($args)
    {
        $field = [
            'key'        => '',
            'label'      => '',
            'name'       => '',
            'type'       => 'user',
            'instr'      => '',
            'required'   => 0,
            'conds'      => 0,
            'wrapper'    => $this->getWrapper(),
            'role'       => [],
            'allow_null' => 1,
            'multiple'   => 0,
        ];

        return $this->parseField($field, $args);
    }

    /**
     * Generate a new number field.
     */
    public function number($args)
    {
        $field = [
            'key'         => '',
            'label'       => '',
            'name'        => '',
            'type'        => 'number',
            'instr'       => '',
            'required'    => 0,
            'conds'       => 0,
            'wrapper'     => $this->getWrapper(),
            'default'     => '',
            'placeholder' => '',
            'prepend'     => '',
            'append'      => '',
            'min'         => '',
            'max'         => '',
            'step'        => '',
        ];

        return $this->parseField($field, $args);
    }

    /**
     * Generate a new google map field.
     */
    public function googleMap($args)
    {
        $field = [
            'key'        => '',
            'label'      => '',
            'name'       => '',
            'type'       => 'google_map',
            'instr'      => '',
            'required'   => 0,
            'conds'      => 0,
            'wrapper'    => $this->getWrapper(),
            'center_lat' => '59.911491',
            'center_lng' => '10.757933',
            'zoom'       => '',
            'height'     => '',
        ];

        return $this->parseField($field, $args);
    }
}
