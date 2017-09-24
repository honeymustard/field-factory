<?php

declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use Honeymustard\FieldFactory\Collections\CondsList;
use Honeymustard\FieldFactory\Conds\Cond;
use Honeymustard\FieldFactory\Conds\Param;

/**
 * @covers CondsList
 */
final class CondsListTest extends TestCase
{
    public function testNewListShouldBeEmpty()
    {
        $list = new CondsList();
        $this->assertEquals($list->length(), 0);
    }

    public function testConjoinOnEmptyShouldFail()
    {
        $this->expectException(Exception::class);

        $list = new CondsList();
        $list->conjoin(new Cond('key_1506260024', '==', '76'));
    }

    public function testConjoinOnNonEmpty()
    {
        $list = new CondsList();
        $list->subjoin(new Cond('key_1506260024', '==', '76'));
        $list->conjoin(new Cond('key_1506260025', '==', '70'));

        $this->assertEquals(
            $list->toArray(),
            [
                [
                    [
                        'field'    => 'key_1506260024',
                        'operator' => '==',
                        'value'    => '76',
                    ],
                    [
                        'field'    => 'key_1506260025',
                        'operator' => '==',
                        'value'    => '70',
                    ],
                ],
            ]
        );
    }

    public function testSubjoinAfterSubjoin()
    {
        $list = new CondsList();
        $list->subjoin(new Cond('key_1506260024', '==', '19'));
        $list->subjoin(new Cond('key_1506260025', '!=', '14'));

        $this->assertEquals(
            $list->toArray(),
            [
                [
                    [
                        'field'    => 'key_1506260024',
                        'operator' => '==',
                        'value'    => '19',
                    ],
                ],
                [
                    [
                        'field'    => 'key_1506260025',
                        'operator' => '!=',
                        'value'    => '14',
                    ],
                ],
            ]
        );
    }

    public function testConjoinToAll()
    {
        $list = new CondsList();
        $list->subjoin(new Cond('key_1506260024', '==', '11'));
        $list->subjoin(new Cond('key_1506260025', '==', '18'));
        $list->conjoin(new Cond('key_1506260026', '!=', '19'));

        $this->assertEquals(
            $list->toArray(),
            [
                [
                    [
                        'field'    => 'key_1506260024',
                        'operator' => '==',
                        'value'    => '11',
                    ],
                    [
                        'field'    => 'key_1506260026',
                        'operator' => '!=',
                        'value'    => '19',
                    ],
                ],
                [
                    [
                        'field'    => 'key_1506260025',
                        'operator' => '==',
                        'value'    => '18',
                    ],
                    [
                        'field'    => 'key_1506260026',
                        'operator' => '!=',
                        'value'    => '19',
                    ],
                ],
            ]
        );
    }

    public function testConjoinToFirstIndex()
    {
        $list = new CondsList();
        $list->subjoin(new Cond('key_1506260024', '==', '11'));
        $list->subjoin(new Cond('key_1506260025', '==', '18'));
        $list->conjoin(new Cond('key_1506260026', '!=', '19'), 0);

        $this->assertEquals(
            $list->toArray(),
            [
                [
                    [
                        'field'    => 'key_1506260024',
                        'operator' => '==',
                        'value'    => '11',
                    ],
                    [
                        'field'    => 'key_1506260026',
                        'operator' => '!=',
                        'value'    => '19',
                    ],
                ],
                [
                    [
                        'field'    => 'key_1506260025',
                        'operator' => '==',
                        'value'    => '18',
                    ],
                ],
            ]
        );
    }

    public function testConjoinOutOfBounds()
    {
        $this->expectException(Exception::class);

        $list = new CondsList();
        $list->subjoin(new Cond('key_1506260024', '==', '11'));
        $list->subjoin(new Cond('key_1506260025', '==', '18'));
        $list->conjoin(new Cond('key_1506260026', '!=', '19'), 2);
    }

    public function testConjoinToLastIndex()
    {
        $list = new CondsList();
        $list->subjoin(new Cond('key_1506260024', '==', '11'));
        $list->subjoin(new Cond('key_1506260025', '==', '18'));
        $list->conjoin(new Cond('key_1506260026', '!=', '19'), 1);

        $this->assertEquals(
            $list->toArray(),
            [
                [
                    [
                        'field'    => 'key_1506260024',
                        'operator' => '==',
                        'value'    => '11',
                    ],
                ],
                [
                    [
                        'field'    => 'key_1506260025',
                        'operator' => '==',
                        'value'    => '18',
                    ],
                    [
                        'field'    => 'key_1506260026',
                        'operator' => '!=',
                        'value'    => '19',
                    ],
                ],
            ]
        );
    }

    public function testSubjoinWithParams()
    {
        $list = new CondsList();
        $list->subjoin(new Param('post_type', '==', 'post'));
        $list->subjoin(new Param('post_type', '==', 'page'));

        $this->assertEquals(
            $list->toArray(),
            [
                [
                    [
                        'param'    => 'post_type',
                        'operator' => '==',
                        'value'    => 'post',
                    ],
                ],
                [
                    [
                        'param'    => 'post_type',
                        'operator' => '==',
                        'value'    => 'page',
                    ],
                ],
            ]
        );
    }
}
