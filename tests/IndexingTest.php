<?php

namespace Tests;

use numphp\np_array;

class IndexingTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @var np_array
     */
    private $list;

    public function setUp()
    {
        $this->list = new np_array([0, 1, 2, 3, 4, 5, 6, 7, 8, 9]);
    }

    public function testSimpleIndex()
    {
        $res = $this->list[2];

        $this->assertEquals($res, 2);
    }

    public function testArrayIndex()
    {
        $res = $this->list[[3,4]];

        $this->assertEquals((array) $res, [3, 4]);
    }

    public function testConditionIndex()
    {
        $res = $this->list[$this->list->gte(5)];

        $this->assertEquals((array) $res, [5, 6, 7, 8, 9]);
    }

    public function testMask()
    {
        $res = $this->list->mask('> 5');

        $this->assertEquals((array) $res, [false, false, false, false, false, false, true, true, true, true]);
    }
}
