<?php

use Honeymustard\FieldFactory\Factory;
use Honeymustard\FieldFactory\Groups\Group;

$fact = new Factory();
$fact->text([
    'key'   => 'library_1489398391',
    'name'  => 'library_text',
    'label' => 'Text',
]);

/**
 * Create a new anonymous group.
 */
$group = new Group([
    'key'    => 'library_1489398390',
    'title'  => 'Library',
    'fields' => $fact,
]);

$group->register();
