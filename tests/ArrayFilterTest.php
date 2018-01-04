<?php

namespace Tests;


use numphp\np_array;
use numphp\operator;

class ArrayFilterTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var np_array
     */
    private $list;

    public function setUp()
    {
        $this->list = new np_array([18, 25, 26, 30, 34]);
    }

    public function testFilter()
    {
        $res = $this->list[operator::b_and($this->list->gt(25), $this->list->lt(30))];
        $this->assertEquals(current($res), [26]);
    }
}
