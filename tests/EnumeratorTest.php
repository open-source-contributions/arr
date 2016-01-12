<?php
namespace Narrowspark\Arr\Tests;

use Narrowspark\Arr\Enumerator;

class EnumeratorTest extends \PHPUnit_Framework_TestCase
{
    protected $enumerator;

    public function setUp()
    {
        $this->enumerator = new Enumerator();
    }

    /**
     * @dataProvider splitProvider
     */
    public function testSplit($expectedArray, $array, $splitIntoNumber, $preserveKeys)
    {
        $this->assertSame(
            $expectedArray,
            $this->enumerator->split($array, $splitIntoNumber, $preserveKeys)
        );
    }

    public function testRandom()
    {
        $this->assertNull($this->enumerator->random([]));

        $testArray = [
            'one'   => 'a',
            'two'   => 'b',
            'three' => 'c',
        ];

        $testArrayValues = array_values($testArray);
        $randomArrayValue = $this->enumerator->random($testArray);

        $this->assertTrue(in_array($randomArrayValue, $testArrayValues));
    }

    public function splitProvider()
    {
        return [
            [
                [['a', 'b'], ['c', 'd']], ['a', 'b', 'c', 'd'], 2, false,
            ],
            [
                [['a', 'b', 'c'], ['d', 'e']], ['a', 'b', 'c', 'd', 'e'], 2, false,
            ],
            [
                [['a', 'b'], ['c', 'd'], ['e']], ['a', 'b', 'c', 'd', 'e'], 3, false,
            ],
            [
                [], [], 2, false,
            ],
            [
                [['a'], ['b']], ['a', 'b'], 2, false,
            ],
            [
                [['a' => 1], ['b' => 2]], ['a' => 1, 'b' => 2], 2, true,
            ],
        ];
    }
}
