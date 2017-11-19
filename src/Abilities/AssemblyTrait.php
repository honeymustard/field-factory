<?php

namespace Honeymustard\FieldFactory\Abilities;

use Honeymustard\FieldFactory\Utils\Maps;

/**
 * Enables an object to get data from database.
 */
trait AssemblyTrait
{
    private $map = [];

    /**
     * Parse the fields into a map.
     *
     * @param string $name The assembly name.
     * @param string $type The ACF field type.
     *
     * @return void
     */
    protected function parse($name, $type)
    {
         $this->map = $this->parseRec($this->getFields(), $name, $type);
    }

    /**
     * Recursively parse the fields into a map.
     *
     * @param string[] $fields A list of field names.
     * @param string   $name   The assembly name.
     * @param string   $type   The ACF field type.
     *
     * @return string[] Returns completed map.
     */
    protected function parseRec($fields, $name, $type)
    {
        foreach ($fields as $k => $v) {
            $lookup = $name.'_'. (is_array($v) ? $k : $v);

            if (is_array($v)) {
                while ($this->haveRows($lookup, $type)) {
                    $temp = the_row();
                    $data[$k][] = $this->parseRec($v, $name, 'subs');
                }
            } elseif ($type === 'option') {
                $data[$v] = get_field($lookup, $type);
            } elseif ($type === 'subs') {
                $data[$v] = get_sub_field($lookup);
            } elseif (is_numeric($type)) {
                $data[$v] = get_field($lookup, intval($type));
            } else {
                $data[$v] = get_field($lookup);
            }
        }

        return $data;
    }

    /**
     * Determine if there are more rows.
     *
     * @param string $lookup Lookup key.
     * @param string $type   The ACF field type.
     *
     * @return boolean
     */
    protected function haveRows($lookup, $type)
    {
        if ($type === 'option') {
            return have_rows($lookup, $type);
        } elseif (is_numeric($type)) {
            return have_rows($lookup, intval($type));
        } else {
            return have_rows($lookup);
        }
    }

    /**
     * Get the list of fields.
     *
     * @return string[]
     */
    abstract protected function getFields();

    /**
     * Get a field value.
     *
     * @param string $name The field name.
     *
     * @return string
     */
    protected function getField($name)
    {
        return Maps::get($name, $this->map, '');
    }
}
