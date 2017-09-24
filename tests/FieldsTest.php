<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use Honeymustard\FieldFactory\Fields;

/**
 * @covers Fields
 */
final class FieldsTest extends TestCase
{
    public function testTextField()
    {
        $field = new Fields\Text([
            'key'   => 'key_1506267126',
            'name'  => 'text',
            'conds' => [],
        ]);

        $field = $field->toArray();

        $this->assertArrayHasKey('key', $field);
        $this->assertArrayHasKey('name', $field);
        $this->assertArrayHasKey('conditional_logic', $field);
        $this->assertArrayNotHasKey('conds', $field);

        $this->assertEquals($field['key'], 'key_1506267126');
        $this->assertEquals($field['name'], 'text');
        $this->assertEquals($field['conditional_logic'], []);
    }
}
