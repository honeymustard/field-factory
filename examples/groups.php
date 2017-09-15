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
                new ContentModule([
                    'key'   => 'layouts_1489398386',
                    'name'  => 'layouts_content',
                    'label' => 'Content Layout',
                ]),
                $this->getImageLayout(),
            ],
        ]);

        return $fact;
    }

    /**
     * Create an anonymous layout.
     *
     * @return AbstractLayout
     */
    protected function getImageLayout()
    {
        $fact = new Factory();

        $fact->image([
            'key'   => 'modules_1489398384',
            'name'  => 'modules_image',
            'label' => 'Image',
        ]);

        return new Layout([
            'key'   => 'layouts_1489398385',
            'name'  => 'layouts_image',
            'label' => 'Image Layout',
            'subs'  => $fact,
        ]);
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
 * Pass a unique ID for this group.
 */
$group = new Modules([
    'key'   => 'modules_1489398390',
    'title' => 'Modules',
]);

$group->register();
