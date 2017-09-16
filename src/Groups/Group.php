<?php

namespace Honeymustard\FieldFactory\Groups;

use Honeymustard\FieldFactory\Factory;
use Honeymustard\FieldFactory\Groups\AbstractGroup;
use Honeymustard\FieldFactory\Collections\CondsList;
use Honeymustard\FieldFactory\Conds\Param;

/**
 * A concrete group implementation.
 */
class Group extends AbstractGroup
{
    /**
     * Get the factory instance.
     *
     * @return Factory
     */
    public function getFactory()
    {
        return new Factory();
    }

    /**
     * Get the locations list.
     *
     * @return CondsList
     */
    public function getLocations() {

        $conds = new CondsList();
        $conds->subjoin(new Param('post_type', '==', 'post'));
        $conds->subjoin(new Param('post_type', '==', 'page'));

        return $conds->toArray();
    }
}
