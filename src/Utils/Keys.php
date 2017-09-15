<?php

namespace Honeymustard\FieldFactory;

/**
 * Disambiguates field keys and field names.
 */
class Keys
{
    private $key = '';
    private $name = '';

    /**
     * Initiate new keys object.
     *
     * @param $key  A suffix for field keys.
     * @param $name A prefix for field names.
     */
    public function __construct($key, $name)
    {
        $this->key = $key;
        $this->name = $name;
    }

    /**
     * Get the complete field key.
     *
     * @param string $name Name for this field.
     *
     * @return string
     */
    protected function getKey($name)
    {
        return $this->name . '_' . $name . '_' . $this->key;
    }

    /**
     * Get the complete field name.
     *
     * @param string $name Name for this field.
     *
     * @return string
     */
    protected function getName($name)
    {
        return $this->name . '_' . $name;
    }
}
