<?php

namespace Tests;

use numphp\np_array;
use numphp\Statistics\Statistics;

class StatisticsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var np_array
     */
    private $list;

    public function setUp()
    {
        $this->list = new np_array([0, 1, 2, 3, 4, 5, 6, 7, 8, 9]);
        $this->listEven = new np_array([0, 1, 2, 3, 4, 5, 6, 7, 8]);
    }

    public function testSum()
    {
        $res = $this->list->sum();

        $this->assertEquals($res, 45);
    }

    public function testMean()
    {
        $res = $this->list->mean();

        $this->assertEquals($res, 4.5);
    }

    public function testMedian()
    {
        $res = $this->list->median();

        $this->assertEquals($res, 4.5);
    }

    public function testMedianEven()
    {
        $res = $this->listEven->median();

        $this->assertEquals($res, 4);
    }

    public function testMin()
    {
        $res = $this->list->min();

        $this->assertEquals($res, 0);
    }

    public function testMax()
    {
        $res = $this->list->max();

        $this->assertEquals($res, 9);
    }

    public function testDescribe()
    {
        $res = $this->list->describe();

        $this->assertEquals(array_keys((array)$res), ['count', 'max', 'mean', 'median', 'min', 'sum']);
    }
}
