<?php

namespace Tests;

use numphp\np_array;
use numphp\Slicing\Slice;

class SliceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var np_array
     */
    private $list;

    public function setUp()
    {
        $this->list = new np_array([0, 1, 2, 3, 4, 5, 6, 7, 8, 9]);
    }

    public function testStartStop()
    {
        $res = $this->list['1:3'];

        $this->assertInstanceOf('numphp\np_array', $res);
        $this->assertEquals((array) $res, [1, 2]);
    }

    public function testStartStopStep()
    {
        $res = $this->list['1:5:2'];

        $this->assertInstanceOf('numphp\np_array', $res);
        $this->assertEquals((array) $res, [1, 3]);
    }

    public function testNegativeStart()
    {
        $res = $this->list['-7:6'];

        $this->assertInstanceOf('numphp\np_array', $res);
        $this->assertEquals((array) $res, [3, 4, 5]);
    }
}
