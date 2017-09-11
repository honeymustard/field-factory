<?php

include(__DIR__ . '/layouts.php');

use Honeymustard\FieldFactory;
use Honeymustard\FieldFactory\Groups;
use Honeymustard\FieldFactory\Collections;
use Honeymustard\FieldFactory\Conds;

/**
 * Create a group named Modules by extending the default group.
 */
class Modules extends Groups\AbstractGroup {

    /**
     * Add a group title.
     *
     * @return string
     */
    public function getTitle() {
        return 'Modules';
    }

    /**
     * Add fields by using the field factory.
     *
     * @return Factory
     */
    public function getFactory() {

        $fact = new FieldFactory\Factory();

        $fact->text([
            'key'   => 'modules_1489398381',
            'name'  => 'modules_text_1',
            'label' => 'Text 1',
        ]);

        $fact->text([
            'key'   => 'modules_1489398382',
            'name'  => 'modules_text_2',
            'label' => 'Text 2',
        ]);

        $fact->flexibleContent([
            'key'     => 'modules_1489398383',
            'name'    => 'modules_flex',
            'label'   => 'Flexible 1',
            'layouts' => [
                new ContentModule('content'),
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

        $conds = new Collections\CondsList();
        $conds->subjoin(new Conds\Param('post_type', '==', 'post'));
        $conds->subjoin(new Conds\Param('post_type', '==', 'page'));

        return $conds->toArray();
    }
}

/**
 * Pass a unique ID for this group.
 */
$group = new Modules('modules');
$group->register();
