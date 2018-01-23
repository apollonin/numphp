<?php

namespace Tests;

use numphp\np_array;
use numphp\operator;

class ComparationsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var np_array
     */
    private $list;

    public function setUp()
    {
        $this->list = new np_array([18, 25, 26, 30, 34]);
    }

    public function testSimpleComparationGt()
    {
        $res = $this->list[$this->list->gt(25)];

        $this->assertEquals((array) $res, [26, 30, 34]);
    }

    public function testSimpleComparationEq()
    {
        $res = $this->list[$this->list->eq(25)];

        $this->assertEquals((array) $res, [25]);
    }

    public function testBitwiseComparations()
    {
        $res = $this->list[operator::b_and($this->list->gt(25), $this->list->lt(30))];
        $this->assertEquals((array) $res, [26]);
    }

    public function testStringComparisonIndex()
    {
        $res = $this->list[$this->list['> 25']];

        $this->assertEquals((array) $res, [26, 30, 34]);
    }

    public function testVectorComparationGt()
    {
        $res = $this->list[$this->list->gt([20, 25, 30, 17, 13])];

        $this->assertEquals((array) $res, [30, 34]);
    }

    public function testVectorComparationEq()
    {
        $res = $this->list[$this->list->eq([18, 25, 26, 25, 34])];

        $this->assertEquals((array) $res, [18, 25, 26, 34]);
    }
}
