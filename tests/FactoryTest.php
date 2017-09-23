<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use Honeymustard\FieldFactory\Factory;

/**
 * @covers Factory
 */
final class FactoryTest extends TestCase
{
    public function testNewFactoryShouldBeEmpty()
    {
        $fact = new Factory();
        $this->assertEquals($fact->length(), 0);
    }

    public function testLengthWithOneField()
    {
        $fact = new Factory();
        $fact->email([
            'key'  => 'text_key',
            'name' => 'text_name'
        ]);

        $this->assertEquals($fact->length(), 1);
    }

    public function testLengthWithTwoFields()
    {
        $fact = new Factory();
        $fact->tab([
            'key'  => 'text_key_1',
            'name' => 'text_name_2'
        ]);

        $fact->text([
            'key'  => 'text_key_1',
            'name' => 'text_name_2'
        ]);

        $this->assertEquals($fact->length(), 2);
    }
}
