<?php

use Honeymustard\FieldFactory\Factory;
use Honeymustard\FieldFactory\Fields;
use Honeymustard\FieldFactory\Groups\Group;
use Honeymustard\FieldFactory\Library\Links\LinkField;

$group = new Group([
    'key'    => 'key_1489398000',
    'title'  => 'Group',
    'fields' => new Factory([
        new Fields\Image([
            'key'   => 'key_1489398001',
            'name'  => 'image',
            'label' => 'Add an image',
        ]),
        new Fields\Text([
            'key'   => 'key_1489398002',
            'name'  => 'title',
            'label' => 'Add a title',
        ]),
        new LinkField([
            'key'   => 'key_1489398003',
            'name'  => 'library_link',
            'type'  => [
                'label' => 'Add a link',
            ],
        ]),
    ]),
]);

$group->register();
