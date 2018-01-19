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

    public function testOperatorAdd()
    {
        $res = $this->list->add(5);

        $this->assertEquals((array) $res, [23, 30, 31, 35, 39]);
    }

    public function testOperatorSub()
    {
        $res = $this->list->sub(10);

        $this->assertEquals((array) $res, [8, 15, 16, 20, 24]);
    }

    public function testOperatorPow()
    {
        $res = $this->list->pow(2);

        $this->assertEquals((array) $res, [324, 625, 676, 900, 1156]);
    }
}
