<?php

namespace Tests;

use numphp\np_array;
use numphp\operator;

class OperatorsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var np_array
     */
    private $list;

    public function setUp()
    {
        $this->list = new np_array([18, 25, 26, 30, 34]);
    }

    public function testAdd()
    {
        $res = $this->list->add(5);

        $this->assertEquals((array) $res, [23, 30, 31, 35, 39]);
    }

    public function testSub()
    {
        $res = $this->list->sub(10);

        $this->assertEquals((array) $res, [8, 15, 16, 20, 24]);
    }

    public function testPow()
    {
        $res = $this->list->pow(2);

        $this->assertEquals((array) $res, [324, 625, 676, 900, 1156]);
    }

    public function testAddVector()
    {
        $res = $this->list->add(new np_array([1, 2, 3, 4, 5]));

        $this->assertEquals((array) $res, [19, 27, 29, 34, 39]);
    }

    public function testAddArray()
    {
        $res = $this->list->add([1, 2, 3, 4, 5]);

        $this->assertEquals((array) $res, [19, 27, 29, 34, 39]);
    }

    public function testSubVector()
    {
        $res = $this->list->sub(new np_array([1, 2, 3, 4, 5]));

        $this->assertEquals((array) $res, [17, 23, 23, 26, 29]);
    }
}
