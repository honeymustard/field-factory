<?php

namespace Honeymustard\FieldFactory\Layouts;

/**
 * Base class for all layouts.
 */
abstract class AbstractLayout
{
    private $id = '';

    /**
     * Construct a new layout.
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
     * @param string $id The layout ID.
     *
     * @return string
     */
    public function setID($id)
    {
        $id = strval($id);

        if (empty($id)) {
            $message = 'A layout must have a valid identifier';
            trigger_error($message, E_USER_ERROR);
        }

        return $id;
    }

    /**
     * Get the layout.
     *
     * @return string[] layout array.
     */
    public function getLayout()
    {
        return [
            'key'        => $this->getKey(),
            'label'      => $this->getLabel(),
            'name'       => $this->getID(),
            'display'    => $this->getDisplay(),
            'sub_fields' => $this->getSubFields(),
            'min'        => $this->getMinLayouts(),
            'max'        => $this->getMaxLayouts(),
        ];
    }

    /**
     * Get the key.
     *
     * @return string
     */
    public function getKey()
    {
        return 'layout_' . $this->getID();
    }

    /**
     * Get the label.
     *
     * @return string
     */
    abstract protected function getLabel();

    /**
     * Get the display value.
     *
     * @return string
     */
    protected function getDisplay()
    {
        return 'block';
    }

    /**
     * Get the sub fields.
     *
     * @return string[] list of sub fields.
     */
    protected function getSubFields()
    {
        return [];
    }

    /**
     * Get the minimum number of layouts.
     *
     * @return string|int
     */
    protected function getMinLayouts()
    {
        return '';
    }

    /**
     * Get the maximum number of layouts.
     *
     * @return string|int
     */
    protected function getMaxLayouts()
    {
        return '';
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
