<?php

use Honeymustard\FieldFactory\Factory;
use Honeymustard\FieldFactory\Layouts\AbstractLayout;

/**
 * Create a layout by extending the default layout.
 */
class ContentModule extends AbstractLayout {

    /**
     * Add fields by using the field factory.
     *
     * @return Factory
     */
    public function getFactory() {

        $fact = new Factory();

        $fact->text([
            'key'   => 'layout_1489398384',
            'name'  => 'layout_text_1',
            'label' => 'Text 1',
        ]);

        return $fact;
    }
}
