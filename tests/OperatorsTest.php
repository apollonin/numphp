<?php

namespace Tests;

use numphp\np_array;

class OperatorsTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @var np_array
     */
    private $list;

    protected function setUp()
    {
        $this->list = new np_array([0, 1, 2, 3, 4, 5, 6, 7, 8, 9]);
    }

    public function testAdd()
    {
        $res = $this->list->add(5);

        $this->assertEquals((array) $res, [5, 6, 7, 8, 9, 10, 11, 12, 13, 14]);
    }

    public function testSub()
    {
        $res = $this->list->sub(10);

        $this->assertEquals((array) $res, [-10, -9, -8, -7, -6, -5, -4, -3, -2, -1]);
    }

    public function testDiv()
    {
        $res = $this->list->div(2);

        $this->assertEquals((array) $res, [0, 0.5, 1, 1.5, 2, 2.5, 3, 3.5, 4, 4.5]);
    }

    public function testPow()
    {
        $res = $this->list->pow(2);

        $this->assertEquals((array) $res, [0, 1, 4, 9, 16, 25,36, 49, 64, 81]);
    }

    public function testMod()
    {
        $res = $this->list->mod(2);

        $this->assertEquals((array) $res, [0, 1, 0, 1, 0, 1, 0, 1, 0, 1]);
    }

    public function testMul()
    {
        $res = $this->list->mul(5);

        $this->assertEquals((array) $res, [0, 5, 10, 15, 20, 25, 30, 35, 40, 45]);
    }

    public function testAddVector()
    {
        $res = $this->list->add(new np_array([9, 8, 7, 6, 5, 4, 3, 2, 1, 0]));

        $this->assertEquals((array) $res, [9, 9, 9, 9, 9, 9, 9, 9, 9, 9]);
    }

    public function testAddArray()
    {
        $res = $this->list->add([9, 8, 7, 6, 5, 4, 3, 2, 1, 0]);

        $this->assertEquals((array) $res, [9, 9, 9, 9, 9, 9, 9, 9, 9, 9]);
    }

    public function testSubVector()
    {
        $res = $this->list->sub(new np_array([10, 10, 10, 10, 10, 10, 10, 10, 10, 10]));

        $this->assertEquals((array) $res, [-10, -9, -8, -7, -6, -5, -4, -3, -2, -1]);
    }

    /**
     * @expectedException \Exception
     */
    public function testExceptionInvalidArg()
    {
        $res = $this->list->add('string');
    }

    /**
     * @expectedException \Exception
     */
    public function testExceptionInvalidOperator()
    {
        $res = $this->list->qqq('string');
    }
}
