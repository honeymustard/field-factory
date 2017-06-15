<?php

namespace Honeymustard\FieldFactory\Collections;

use Honeymustard\FieldFactory\Conds;

/**
 * Class to handle lists of conditionals.
 */
class CondsList extends AbstractList
{
    private $conds = [];

    /**
     * Set the initial list.
     *
     * @param AbstractCond[] $conds Initial list of conds.
     */
    public function __construct($conds = [])
    {
        $this->conds = $conds;
    }

    /**
     * Get list of conds.
     *
     * @return AbstractCond[] List of conds.
     */
    public function getConds()
    {
        return $this->conds;
    }

    /**
     * Get list of conds as an array.
     *
     * @return string[][] List of conds.
     */
    public function toArray()
    {
        $list = [];
        $conds = $this->getConds();

        for ($i = 0; $i < count($conds); $i++) {
            for ($j = 0; $j < count($conds[$i]); $j++) {
                $list[$i][$j] = $conds[$i][$j]->toArray();
            }
        }

        return $list;
    }

    /**
     * Add a condition to the conds list.
     *
     * @param AbstractCond $cond Condition to add.
     * @return void
     */
    public function subjoin(Conds\AbstractCond $cond)
    {
        $conds = $this->getConds();
        array_push($conds, [$cond]);
        $this->conds = $conds;
    }

    /**
     * Add a condition to one or all conditions.
     *
     * @param AbstractCond $cond Single condition to add.
     * @return void
     */
    public function conjoin(Conds\AbstractCond $cond, $index = -1)
    {
        $conds = $this->getConds();
        $length = $this->length();

        if ($length === 0) {
            throw new \Exception('Cannot conjoin on empty list');
        }

        if ($index >= 0) {
            array_push($conds[$index], $cond);
        } else {
            for ($i = 0; $i < $length; $i++) {
                array_push($conds[$i], $cond);
            }
        }

        $this->conds = $conds;
    }

    /**
     * Get the list length.
     *
     * @return int
     */
    public function length()
    {
        return count($this->getConds());
    }
}
