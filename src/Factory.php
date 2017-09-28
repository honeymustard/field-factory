<?php

namespace Honeymustard\FieldFactory;

use Honeymustard\FieldFactory\Fields;
use Honeymustard\FieldFactory\Fields\AbstractField;
use Honeymustard\FieldFactory\Collections\GenericList;
use Honeymustard\FieldFactory\Utils\Maps;
use Honeymustard\FieldFactory\Utils\Converter;
use Honeymustard\FieldFactory\Interfaces\FieldInterface;
use Honeymustard\FieldFactory\Library\AbstractLibrary;

/**
 * Field generator class for all field types.
 */
class Factory
{
    private $list = null;

    /**
     * Construct a new factory.
     *
     * @param FieldInterface[] $fields Initial list of fields.
     */
    public function __construct($fields = [])
    {
        $this->list = new GenericList();

        if (!empty($fields)) {
            foreach ($fields as $field) {
                $this->append($field);
            }
        }
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
     * @return FieldInterface[]
     */
    public function getFields()
    {
        return $this->list->getList();
    }

    /**
     * Get the field list.
     *
     * @return GenericList
     */
    protected function getList()
    {
        return $this->list;
    }

    /**
     * Append a field to the factory list.
     *
     * @param FieldInterface $field A valid field type.
     *
     * @return Factory
     */
    public function append(FieldInterface $field)
    {
        $list = $this->getList();

        if ($field->getIdentity() === 'library') {
            $items = $field->toArray();

            foreach ($items as $item) {
                $list->push($this->create($item));
            }
        } else {
            $list->push($field);
        }

        return $this;
    }

    /**
     * Create a field object from a list of args.
     *
     * @param string[] $args List of arguments.
     *
     * @return AbstractField
     */
    public static function create($args)
    {
        switch (Maps::get('type', $args, '')) {
            case 'checkbox':
                return new Fields\Checkbox($args);
            case 'color_picker':
                return new Fields\ColorPicker($args);
            case 'date_time_picker':
                return new Fields\DateTimePicker($args);
            case 'email':
                return new Fields\Email($args);
            case 'file':
                return new Fields\File($args);
            case 'flexible_content':
                return new Fields\FlexibleContent($args);
            case 'google_map':
                return new Fields\GoogleMap($args);
            case 'image':
                return new Fields\Image($args);
            case 'message':
                return new Fields\Message($args);
            case 'number':
                return new Fields\Number($args);
            case 'oembed':
                return new Fields\Oembed($args);
            case 'post_object':
                return new Fields\PostObject($args);
            case 'radio':
                return new Fields\Radio($args);
            case 'relationship':
                return new Fields\Relationship($args);
            case 'repeater':
                return new Fields\Repeater($args);
            case 'select':
                return new Fields\Select($args);
            case 'tab':
                return new Fields\Tab($args);
            case 'text':
                return new Fields\Text($args);
            case 'textarea':
                return new Fields\Textarea($args);
            case 'true_false':
                return new Fields\TrueFalse($args);
            case 'url':
                return new Fields\URL($args);
            case 'user':
                return new Fields\User($args);
            case 'wysiwyg':
                return new Fields\Wysiwyg($args);
            case 'password':
                return new Fields\Password($args);
            case 'gallery':
                return new Fields\Gallery($args);
            case 'page_link':
                return new Fields\PageLink($args);
            case 'taxonomy':
                return new Fields\Taxonomy($args);
            case 'date_picker':
                return new Fields\DatePicker($args);
            default:
                return new Fields\Unknown($args);
        }

        throw new \Exception('Could not create item from unknown type');
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
     * Generate a new user field.
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

    /**
     * Generate a new password field.
     *
     * @return Factory
     */
    public function password($args)
    {
        return $this->append(new Fields\Password($args));
    }

    /**
     * Generate a new gallery field.
     *
     * @return Factory
     */
    public function gallery($args)
    {
        return $this->append(new Fields\Gallery($args));
    }

    /**
     * Generate a new page link field.
     *
     * @return Factory
     */
    public function pageLink($args)
    {
        return $this->append(new Fields\PageLink($args));
    }

    /**
     * Generate a new taxonomy field.
     *
     * @return Factory
     */
    public function taxonomy($args)
    {
        return $this->append(new Fields\Taxonomy($args));
    }

    /**
     * Generate a new date picker field.
     *
     * @return Factory
     */
    public function datePicker($args)
    {
        return $this->append(new Fields\DatePicker($args));
    }
}
