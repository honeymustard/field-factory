<?php

namespace Honeymustard\FieldFactory\Conds;

/**
 * Class for a single parameter.
 */
final class Param extends AbstractCond
{
    /**
     * Convert object to an array.
     *
     * @return string[]
     */
    public function toArray()
    {
        return [
            'param'    => $this->getKey(),
            'operator' => $this->getOperator(),
            'value'    => $this->getValue(),
        ];
    }
}
