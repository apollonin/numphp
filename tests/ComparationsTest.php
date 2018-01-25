<?php

namespace Tests;

use numphp\np_array;
use numphp\Operator\Bitwise;

class ComparationsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var np_array
     */
    private $list;

    public function setUp()
    {
        $this->list = new np_array([0, 1, 2, 3, 4, 5, 6, 7, 8, 9]);
    }

    public function testSimpleComparationGt()
    {
        $res = $this->list[$this->list->gt(5)];

        $this->assertEquals((array) $res, [6, 7, 8, 9]);
    }

    public function testSimpleComparationEq()
    {
        $res = $this->list[$this->list->eq(5)];

        $this->assertEquals((array) $res, [5]);
    }

    public function testBitwiseComparations()
    {
        $res = $this->list[Bitwise::b_and($this->list->gt(5), $this->list->lt(9))];
        $this->assertEquals((array) $res, [6, 7, 8]);
    }

    public function testStringComparisonIndex()
    {
        $res = $this->list[$this->list['> 5']];

        $this->assertEquals((array) $res, [6, 7, 8, 9]);
    }

    public function testVectorComparationGt()
    {
        $res = $this->list[$this->list->gt([5, 6, 7, 8, 9, 3, 4, 5, 6, 7])];

        $this->assertEquals((array) $res, [5, 6, 7, 8, 9]);
    }

    public function testVectorComparationEq()
    {
        $res = $this->list[$this->list->eq([0, 5, 6, 7, 4, 3, 5, 6, 7, 8])];

        $this->assertEquals((array) $res, [0, 4]);
    }
}
