<?php

namespace Tests;

use numphp\np_array;
use numphp\operator;

class SetItemsTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var np_array
     */
    private $list;

    public function setUp()
    {
        $this->list = new np_array([18, 25, 26, 30, 34]);
    }

    public function testAddNewItemIndex()
    {
        $res = clone($this->list);
        $res[] = 999;

        $this->assertEquals((array) $res, [18, 25, 26, 30, 34, 999]);
    }

    public function testChangeItemByIndex()
    {
        $res = clone($this->list);
        $res[2] = 999;

        $this->assertEquals((array) $res, [18, 25, 999, 30, 34]);
    }

    public function testChangeItemByCondition()
    {
        $res = clone($this->list);
        $res[$res->lt(26)] = 999;

        $this->assertEquals((array) $res, [999, 999, 26, 30, 34]);
    }

    public function testAddItemAndChangeAll()
    {
        $res = clone($this->list);
        $res[] = 10;
        $res[$res->lt(999)] = 999;

        $this->assertEquals((array) $res, [999, 999, 999, 999, 999, 999]);
    }
    
}
