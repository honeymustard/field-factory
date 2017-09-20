<?php

use Honeymustard\FieldFactory\Factory;
use Honeymustard\FieldFactory\Groups\Group;
use Honeymustard\FieldFactory\Library\Links\LinkField;

/**
 * Add a library to the factory list.
 *
 * The key and name values will be used
 * to disambiguate all internal fields.
 *
 * Values from sub fields can be overidden
 * by using the field name as a key.
 */
$field = new LinkField([
    'key'   => 'key_1489398392',
    'name'  => 'library_link',
    'types' => ['none', 'internal', 'external', 'email'],
    'style' => false,
    'type'  => [
        'label' => 'Override the type label',
    ],
]);

$fact = new Factory();
$fact->append($field);

/**
 * Create an anonymous group.
 */
$group = new Group([
    'key'    => 'key_1489398390',
    'title'  => 'Library',
    'fields' => $fact,
]);

$group->register();
