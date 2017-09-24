<?php

namespace Honeymustard\FieldFactory\Collections;

use Honeymustard\FieldFactory\Conds\AbstractCond;
use Honeymustard\FieldFactory\Interfaces\ArrayableInterface;

/**
 * Class to handle lists of conditionals.
 */
class CondsList extends AbstractList implements ArrayableInterface
{
    /**
     * Set the initial list.
     *
     * @param AbstractCond[] $conds Initial list of conds.
     */
    public function __construct($conds = [])
    {
        foreach ($conds as $cond) {
            $this->subjoin($cond);
        }
    }

    /**
     * Get list of conds as an array.
     *
     * @return string[][] List of conds.
     */
    public function toArray()
    {
        $temp = [];
        $conds = $this->getList();

        for ($i = 0; $i < count($conds); $i++) {
            for ($j = 0; $j < count($conds[$i]); $j++) {
                $temp[$i][$j] = $conds[$i][$j]->toArray();
            }
        }

        return $temp;
    }

    /**
     * Add a condition to the conds list.
     *
     * @param AbstractCond $cond Condition to add.
     *
     * @return CondsList
     */
    public function subjoin(AbstractCond $cond)
    {
        $this->push([$cond]);
        return $this;
    }

    /**
     * Add a condition to one or all conditions.
     *
     * @param AbstractCond $cond Condition to add.
     * @param int $index         Conjoin at an optional index.
     *
     * @return CondsList
     */
    public function conjoin(AbstractCond $cond, $index = -1)
    {
        $length = $this->length();

        if ($length === 0) {
            $message = 'Cannot conjoin on empty list';
            throw new \Exception($message);
        }

        if ($index >= 0) {
            $item = array_merge($this->getItem($index), [$cond]);
            $this->setItem($item, $index);
        } else {
            for ($i = 0; $i < $length; $i++) {
                $item = array_merge($this->getItem($i), [$cond]);
                $this->setItem($item, $i);
            }
        }

        return $this;
    }
}
