<?php

namespace Honeymustard\FieldFactory\Groups;

/**
 * Base class for all groups.
 */
abstract class AbstractGroup
{
    private $id = '';

    /**
     * Construct a new group.
     *
     * @param string $id A unique ID.
     */
    public function __construct($id)
    {
        $this->id = $this->setID($id);
    }

    /**
     * Set the ID.
     *
     * @param string $id The group ID.
     *
     * @return string
     */
    protected function setID($id)
    {
        $id = strval($id);

        if (empty($id)) {
            $message = 'A group must have a valid identifier';
            trigger_error($message, E_USER_ERROR);
        }

        return $id;
    }

    /**
     * Get the key.
     *
     * @return string
     */
    public function getKey()
    {
        return 'group_'.$this->getID();
    }

    /**
     * Get the title.
     *
     * @return string
     */
    abstract public function getTitle();

    /**
     * Get the list of fields.
     *
     * @return string[]
     */
    abstract public function getFields();

    /**
     * Get a list of locations.
     *
     * @return string[]
     */
    abstract public function getLocations();

    /**
     * Get the complete group.
     *
     * @return string[]
     */
    public function getGroup()
    {
        return [
            'key'                   => $this->getKey(),
            'title'                 => $this->getTitle(),
            'fields'                => $this->getFields(),
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
     * Get the ID.
     *
     * @return string
     */
    public function getID()
    {
        return $this->id;
    }
}
