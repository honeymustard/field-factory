<?php

use Honeymustard\FieldFactory;
use Honeymustard\FieldFactory\Layouts;

/**
 * Create a layout by extending the default layout.
 */
class ContentModule extends Layouts\AbstractLayout {

    /**
     * Add fields by using the field factory.
     *
     * @return Factory
     */
    public function getFactory() {

        $fact = new FieldFactory\Factory();

        $fact->text([
            'key'   => 'layout_1489398384',
            'name'  => 'layout_text_1',
            'label' => 'Text 1',
        ]);

        return $fact;
    }
}
