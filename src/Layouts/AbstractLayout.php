<?php

namespace Honeymustard\FieldFactory\Layouts;

use Honeymustard\FieldFactory\Factory;

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
    final protected function setID($id)
    {
        $id = strval($id);

        if (empty($id)) {
            $message = 'A layout must have a valid identifier';
            throw new \Exception($message);
        }

        return $id;
    }

    /**
     * Get the complete layout.
     *
     * @return string[] layout array.
     */
    public function getArgs()
    {
        return [
            'key'        => $this->getKey(),
            'label'      => $this->getLabel(),
            'name'       => $this->getID(),
            'display'    => $this->getDisplay(),
            'sub_fields' => $this->getFactory()->toArray(),
            'min'        => $this->getMinLayouts(),
            'max'        => $this->getMaxLayouts(),
        ];
    }

    /**
     * Get the list of fields.
     *
     * @return string[]
     */
    abstract public function getFactory();

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
    public function getLabel()
    {
        return 'FieldFactory\Layout';
    }

    /**
     * Get the display value.
     *
     * @return string
     */
    public function getDisplay()
    {
        return 'block';
    }

    /**
     * Get the minimum number of layouts.
     *
     * @return string|int
     */
    public function getMinLayouts()
    {
        return '';
    }

    /**
     * Get the maximum number of layouts.
     *
     * @return string|int
     */
    public function getMaxLayouts()
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
