<?php

namespace Honeymustard\FieldFactory\Groups;

use Honeymustard\FieldFactory\Factory;
use Honeymustard\FieldFactory\Utils\Maps;
use Honeymustard\FieldFactory\Utils\Translator;
use Honeymustard\FieldFactory\Abilities\Mergable;
use Honeymustard\FieldFactory\Dictionaries\FieldDictionary;

/**
 * Base class for all groups.
 */
abstract class AbstractGroup
{
    use Mergable;

    private $args = [];
    private $translator = null;

    /**
     * Construct a new group.
     *
     * @param string[] $args A list of field arguments.
     */
    public function __construct($args)
    {
        $this->args = $args;
        $this->translator = new Translator(new FieldDictionary());
    }

    /**
     * Register this group.
     *
     * @return void
     */
    public function register()
    {
        add_action('init', function () {
            acf_add_local_field_group($this->toArray());
        });
    }

    /**
     * Get the title.
     *
     * @return string
     */
    public function getTitle()
    {
        return 'FieldFactory\Group';
    }

    /**
     * Get the list of fields.
     *
     * @return string[]
     */
    abstract public function getFactory();

    /**
     * Get a list of locations.
     *
     * @return string[]
     */
    abstract public function getLocations();

    /**
     * Get the default arguments.
     *
     * @return string[]
     */
    final protected function getDefaultArgs()
    {
        return [
            'key'                   => '',
            'title'                 => $this->getTitle(),
            'fields'                => $this->getFactory(),
            'location'              => $this->getLocations(),
            'menu_order'            => $this->getMenuOrder(),
            'position'              => $this->getPosition(),
            'style'                 => $this->getStyle(),
            'label_placement'       => $this->getLabelPlacement(),
            'instruction_placement' => $this->getInstructionPlacement(),
            'hide_on_screen'        => $this->getHideOnScreen(),
            'active'                => $this->getActive(),
            'description'           => $this->getDescription(),
        ];
    }

    /**
     * Get the default arguments from a subtype.
     *
     * @return string[]
     */
    protected function getFieldArgs()
    {
        return [];
    }

    /**
     * Get the menu order.
     *
     * @return int
     */
    public function getMenuOrder()
    {
        return 0;
    }

    /**
     * Get the position.
     *
     * @return string
     */
    public function getPosition()
    {
        return 'normal';
    }

    /**
     * Get the style.
     *
     * @return string
     */
    public function getStyle()
    {
        return 'default';
    }

    /**
     * Get the label placement.
     *
     * @return string
     */
    public function getLabelPlacement()
    {
        return 'top';
    }

    /**
     * Get the instruction placement.
     *
     * @return string
     */
    public function getInstructionPlacement()
    {
        return 'label';
    }

    /**
     * Get the active value.
     *
     * @return int
     */
    public function getActive()
    {
        return 1;
    }

    /**
     * Get the description.
     *
     * @return string[]
     */
    public function getDescription()
    {
        return '';
    }

    /**
     * Get a list of things to hide.
     *
     * @return string[]
     */
    public function getHideOnScreen()
    {
        return [
            'the_content',
            'excerpt',
            'discussion',
            'comments',
            'format',
            'featured_image',
            'send-trackbacks',
        ];
    }

    /**
     * Verify a list of arguments.
     *
     * @param string[] $args List of arguments.
     *
     * @return string[]
     */
    protected function verify($args)
    {
        Maps::require('key', $args);
        Maps::require('fields', $args);

        return $args;
    }

    /**
     * Get the translator.
     *
     * @return Translator
     */
    public function getTranslator()
    {
        return $this->translator;
    }

    /**
     * Get the arguments.
     *
     * @return string[]
     */
    public function getArgs()
    {
        return $this->args;
    }

    /**
     * Convert field to an array.
     *
     * @return string[]
     */
    final public function toArray()
    {
        return $this->parse([
            $this->getDefaultArgs(),
            $this->getFieldArgs(),
            $this->getArgs(),
        ]);
    }
}
