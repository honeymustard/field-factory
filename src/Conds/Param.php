<?php

namespace Honeymustard\FieldFactory\Conds;

/**
 * Class for a single parameter.
 */
class Param extends AbstractCond
{
    /**
     * Implements abstract method toArray.
     * @override
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
