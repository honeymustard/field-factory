<?php

include(__DIR__ . '/layouts.php');

use Honeymustard\FieldFactory\Factory;
use Honeymustard\FieldFactory\Groups\AbstractGroup;
use Honeymustard\FieldFactory\Collections\CondsList;
use Honeymustard\FieldFactory\Conds;
use Honeymustard\FieldFactory\Layouts\Layout;

/**
 * Create a group named Modules by extending the default group.
 */
class Modules extends AbstractGroup {

    /**
     * Add fields by using the field factory.
     *
     * @return Factory
     */
    public function getFactory() {

        $fact = new Factory();
        $fact->text([
            'key'   => 'key_1489398381',
            'name'  => 'modules_title',
            'label' => 'Title',
        ]);

        $fact->flexibleContent([
            'key'     => 'key_1489398383',
            'name'    => 'modules',
            'label'   => 'Modules',
            'layouts' => [
                new ContentModule([
                    'key'   => 'key_1489398386',
                    'name'  => 'content_layout',
                    'label' => 'Content Layout',
                ]),
            ],
        ]);

        return $fact;
    }

    /**
     * Add locations by using a conditions lists.
     *
     * @return CondsList
     */
    public function getLocations() {

        $conds = new CondsList();
        $conds->subjoin(new Conds\Param('post_type', '==', 'post'));
        $conds->subjoin(new Conds\Param('post_type', '==', 'page'));

        return $conds->toArray();
    }
}

/**
 * Create a new group for modules.
 */
$group = new Modules([
    'key'   => 'key_1489398390',
    'title' => 'Modules',
]);

$group->register();
