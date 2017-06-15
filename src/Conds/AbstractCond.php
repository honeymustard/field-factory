<?php

namespace Honeymustard\FieldFactory\Conds;

/**
 * Base class for a all conditionals.
 */
abstract class AbstractCond
{
    protected $key = '';
    protected $operator = '';
    protected $value = '';

    /**
     * Initiate a new condition.
     *
     * @param string $key      The field key.
     * @param string $operator Comparision operator.
     * @param string $value    Value to compare against.
     */
    public function __construct($key, $operator, $value)
    {
        $this->key = $key;
        $this->operator = $operator;
        $this->value = $value;
    }

    /**
     * Get the key.
     *
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Get the operator.
     *
     * @return string
     */
    public function getOperator()
    {
        return $this->operator;
    }

    /**
     * Get the value.
     *
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Get the conditionals map as an array.
     *
     * @return string[]
     */
    abstract public function toArray();
}
