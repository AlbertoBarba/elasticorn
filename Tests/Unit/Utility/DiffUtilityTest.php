<?php
declare(strict_types = 1);
namespace T3G\Elasticorn\Tests\Unit\Utility;

use PHPUnit\Framework\TestCase;
use T3G\Elasticorn\Utility\DiffUtility;

class DiffUtilityTest extends TestCase
{

    /**
     * @test
     * @return void
     */
    public function compareArraysDiffsArraysOrderIndependent()
    {
        $arr = [
            'id' =>
                [
                    'type' => 'integer',
                ],
            'username' =>
                [
                    'type' => 'string',
                    'index' => 'not_analyzed',
                    'store' => true,
                ],
            'fullname' =>
                [
                    'type' => 'string',
                    'index' => 'not_analyzed',
                    'store' => true,
                ],
            'email' =>
                [
                    'type' => 'integer',
                    'index' => 'not_analyzed',
                    'store' => true,
                ],
            'avatar' =>
                [
                    'type' => 'string',
                ],
        ];

        $arr2 = [
            'avatar' =>
                [
                    'type' => 'string',
                ],
            'email' =>
                [
                    'type' => 'string',
                    'index' => 'not_analyzed',
                    'store' => true,
                ],
            'fullname' =>
                [
                    'type' => 'string',
                    'index' => 'not_analyzed',
                    'store' => true,
                ],
            'id' =>
                [
                    'type' => 'integer',
                ],
            'username' =>
                [
                    'type' => 'string',
                    'index' => 'not_analyzed',
                    'store' => true,
                ],
        ];
        $expected1 = '-    [email.type] => integer';
        $expected2 = '+    [email.type] => string';

        $diffUtility = new DiffUtility();
        $result = $diffUtility->diff($arr, $arr2);

        self::assertContains($expected1, $result);
        self::assertContains($expected2, $result);
    }

    /**
     * @test
     * @return void
     */
    public function diffWithoutChangesTest()
    {
        $arr = [
            'id' =>
                [
                    'type' => 'integer',
                ],
            'username' =>
                [
                    'type' => 'string',
                    'index' => 'not_analyzed',
                    'store' => true,
                ],
            'fullname' =>
                [
                    'type' => 'string',
                    'index' => 'not_analyzed',
                    'store' => true,
                ],
            'email' =>
                [
                    'type' => 'integer',
                    'index' => 'not_analyzed',
                    'store' => true,
                ],
            'avatar' =>
                [
                    'type' => 'string',
                ],
        ];

        $diffUtility = new DiffUtility();
        $diff = $diffUtility->diff($arr, $arr);

        self::assertSame('', $diff);
    }
}
