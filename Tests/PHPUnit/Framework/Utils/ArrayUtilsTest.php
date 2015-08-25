<?php

require_once __DIR__ . '/../../../../phpOMS/Autoloader.php';

class ArrayUtilsTest extends PHPUnit_Framework_TestCase
{
    public function testArrays()
    {
        $expected = [
            'a' => [
                'aa' => 1,
                'ab' => [
                    'aba',
                    'abb'
                ]
            ],
            2 => '2a'
        ];

        $expected_str = "['a' => ['aa' => 1, 'ab' => [0 => 'aba', 1 => 'abb', ], ], 2 => '2a', ]";

        $actual = [];

        $actual = \phpOMS\Utils\ArrayUtils::setArray('a/aa', $actual, 1, '/');
        $actual = \phpOMS\Utils\ArrayUtils::setArray('a/ab', $actual, ['aba'], '/');
        $actual = \phpOMS\Utils\ArrayUtils::setArray('a/ab', $actual, 'abb', '/');
        $actual = \phpOMS\Utils\ArrayUtils::setArray('2', $actual, '2a', '/');

        $this->assertEquals($expected, $actual);
        $this->assertTrue(\phpOMS\Utils\ArrayUtils::inArrayRecursive('aba', $expected));
        $this->assertFalse(\phpOMS\Utils\ArrayUtils::inArrayRecursive('aba', \phpOMS\Utils\ArrayUtils::unsetArray('a/ab', $actual, '/')));
        $this->assertEquals($expected_str, \phpOMS\Utils\ArrayUtils::stringify($expected));
    }
}
