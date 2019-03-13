<?php

namespace Tests;

use numphp\np_array;

class SetItemsTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @var np_array
     */
    private $list;

    protected function setUp()
    {
        $this->list = new np_array([0, 1, 2, 3, 4, 5, 6, 7, 8, 9]);

        $this->matrix = new np_array([[0, 1, 2, 3], [4, 5, 6, 7], [8, 9, 10, 11]]);
    }

    public function testAddNewItemIndex()
    {
        $res = clone($this->list);
        $res[] = 999;

        $this->assertEquals((array) $res, [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 999]);
    }

    public function testChangeItemByIndex()
    {
        $res = clone($this->list);
        $res[2] = 999;

        $this->assertEquals((array) $res, [0, 1, 999, 3, 4, 5, 6, 7, 8, 9]);
    }

    public function testChangeItemByCondition()
    {
        $res = clone($this->list);
        $res[$res->lt(5)] = 999;

        $this->assertEquals((array) $res, [999, 999, 999, 999, 999, 5, 6, 7, 8, 9]);
    }

    public function testAddItemAndChangeAll()
    {
        $res = clone($this->list);
        $res[] = 10;
        $res[$res->lt(999)] = 999;

        $this->assertEquals((array) $res, [999, 999, 999, 999, 999, 999, 999, 999, 999, 999, 999]);
    }
    
    public function testChangeItemByConditionStringIndex()
    {
        $res = clone($this->list);
        $res[$res['< 5']] = 999;

        $this->assertEquals((array) $res, [999, 999, 999, 999, 999, 5, 6, 7, 8, 9]);
    }

    public function testSetItemsBySlice()
    {
        $res = clone($this->list);
        $res['1:3'] = 999;

        $this->assertEquals((array) $res, [0, 999, 999, 3, 4, 5, 6, 7, 8, 9]);
    }


    /**
     * Matrix
     */
    
    public function testMatrixChangeItemByCondition()
    {
        $res = clone($this->matrix);
        $res[$res->gte(5)] = 999;

        $this->assertEquals($res, new np_array([[0, 1, 2, 3], [4, 999, 999, 999], [999, 999, 999, 999]]));
    }
}
