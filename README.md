# Field Factory

A facade library for Advanced Custom Fields.

## An example
```php
<?php
use Honeymustard\FieldFactory\Factory;
use Honeymustard\FieldFactory\Fields;
use Honeymustard\FieldFactory\Groups\Group;
use Honeymustard\FieldFactory\Library\CommonLink;

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
        new CommonLink([
            'key'   => 'key_1489398003',
            'name'  => 'link',
            'type'  => [
                'label' => 'Add a link',
            ],
        ]),
    ]),
]);

$group->register();
```

## Extraction
While conventional fields under the Fields namespace can be extracted by using ordinary ACF functions,  
Library fields are constructed by using an associated assembler.

```php
<?php
use Honeymustard\FieldFactory\Assemblers\CommonLink;

$link = CommonLink::assemble('link');
echo $link->url;
```

## Testing
Run codesniffer and unit tests.
```
$ composer test
```

## Copyright
Licensed under the MIT license (MIT).  
Copyright &copy; 2017 Adrian Solumsmo.
