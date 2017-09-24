<?php

namespace Honeymustard\FieldFactory\Conds;

/**
 * Class for a single acf conditional.
 */
final class Cond extends AbstractCond
{
    /**
     * Implements abstract method toArray.
     *
     * @override
     */
    public function toArray()
    {
        return [
            'field'    => $this->getKey(),
            'operator' => $this->getOperator(),
            'value'    => $this->getValue(),
        ];
    }
}
