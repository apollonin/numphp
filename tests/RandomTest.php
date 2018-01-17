<?php

namespace Tests;

use numphp\np_array;
use numphp\Random\Random;

class RandomTest extends \PHPUnit_Framework_TestCase
{
    public function testSimpleRandom()
    {
        $res = Random::rand();

        $this->assertLessThan(1, $res);
    }

    public function testGenerateRandomArray()
    {
        $res = Random::rand(5);

        $this->assertInstanceOf('numphp\np_array', $res);
        $this->assertEquals(count($res->getData()), 5);

        foreach ($res as $item)
        {
            $this->assertLessThan(1, $item);
        }
    }

    public function testRandomInt()
    {
        $res = Random::randint(15);

        $this->assertGreaterThanOrEqual(0, $res);
        $this->assertLessThanOrEqual(15, $res);
    }

    public function testRandomIntInterval()
    {
        $res = Random::randint(10, 15);

        $this->assertGreaterThanOrEqual(10, $res);
        $this->assertLessThanOrEqual(15, $res);
    }

    public function testRandomIntIntervalWithSize()
    {
        $res = Random::randint(10, 15, 5);

        $this->assertInstanceOf('numphp\np_array', $res);
        $this->assertEquals(count($res->getData()), 5);

        foreach ($res as $item)
        {
            $this->assertGreaterThanOrEqual(10, $item);
            $this->assertLessThanOrEqual(15, $item);
        }
    }
}
