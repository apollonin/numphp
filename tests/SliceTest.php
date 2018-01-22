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
        $this->list = new np_array([18, 25, 26, 30, 34]);
    }

    public function testSliceStartStop()
    {
        $res = $this->list['1:3'];

        $this->assertInstanceOf('numphp\np_array', $res);
        $this->assertEquals((array) $res, [25, 26]);
    }


    public function testSliceStartStopStep()
    {
        $res = $this->list['1:5:2'];

        $this->assertInstanceOf('numphp\np_array', $res);
        $this->assertEquals((array) $res, [25, 30]);
    }

    
}
