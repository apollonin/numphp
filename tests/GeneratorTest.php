<?php

namespace Tests;

use numphp\np_array;
use numphp\Generator\Generator;

class GeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function testOnes()
    {
        $res = Generator::ones(5);

        $this->assertInstanceOf('numphp\np_array', $res);
        $this->assertEquals(count($res), 5);

        foreach ($res as $item)
        {
            $this->assertEquals(1, $item);
        }
    }

    public function testZeros()
    {
        $res = Generator::zeros(5);

        $this->assertInstanceOf('numphp\np_array', $res);
        $this->assertEquals(count($res), 5);

        foreach ($res as $item)
        {
            $this->assertEquals(0, $item);
        }
    }

    public function testFull()
    {
        $res = Generator::full(15, 9999);

        $this->assertInstanceOf('numphp\np_array', $res);
        $this->assertEquals(count($res), 15);

        foreach ($res as $item)
        {
            $this->assertEquals(9999, $item);
        }
    }

    public function testFullException()
    {
        $this->expectException(\Exception::class);

        $res = Generator::full(15, 'hi there');
    }

    public function testArange()
    {
        $res = Generator::arange(1, 15, 2);

        $this->assertInstanceOf('numphp\np_array', $res);
        $this->assertEquals(count($res), 7);

        $this->assertEquals($res->getData(), [1, 3, 5, 7, 9, 11, 13]);
    }
}
