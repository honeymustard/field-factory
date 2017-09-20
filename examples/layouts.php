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

        $fact->textarea([
            'key'   => 'key_1489398384',
            'name'  => 'content',
            'label' => 'Content',
        ]);

        return $fact;
    }
}
