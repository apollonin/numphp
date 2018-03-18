<?php

namespace Tests;

use numphp\np_array;
use numphp\Operator\Bitwise;

class ComparationsTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @var np_array
     */
    private $list;

    public function setUp()
    {
        $this->list = new np_array([0, 1, 2, 3, 4, 5, 6, 7, 8, 9]);

        $this->matrix = new np_array([[0, 1, 2, 3], [4, 5, 6, 7], [8, 9, 10, 11]]);
    }

    public function testSimpleGt()
    {
        $res = $this->list[$this->list->gt(5)];

        $this->assertEquals((array) $res, [6, 7, 8, 9]);
    }

    public function testSimpleEq()
    {
        $res = $this->list[$this->list->eq(5)];

        $this->assertEquals((array) $res, [5]);
    }

    public function testSimpleLt()
    {
        $res = $this->list[$this->list->lt(5)];

        $this->assertEquals((array) $res, [0, 1, 2, 3, 4]);
    }

    public function testSimpleLte()
    {
        $res = $this->list[$this->list->lte(5)];

        $this->assertEquals((array) $res, [0, 1, 2, 3, 4, 5]);
    }

    public function testSimpleNeq()
    {
        $res = $this->list[$this->list->neq(5)];

        $this->assertEquals((array) $res, [0, 1, 2, 3, 4, 6, 7, 8, 9]);
    }

    public function testBitwiseAnd()
    {
        $res = $this->list[Bitwise::b_and($this->list->gt(5), $this->list->lt(9))];
        $this->assertEquals((array) $res, [6, 7, 8]);
    }

    public function testBitwiseOe()
    {
        $res = $this->list[Bitwise::b_or($this->list->gt(8), $this->list->lt(2))];
        $this->assertEquals((array) $res, [0, 1, 9]);
    }

    public function testStringIndex()
    {
        $res = $this->list[$this->list['> 5']];

        $this->assertEquals((array) $res, [6, 7, 8, 9]);
    }

    public function testVectorGt()
    {
        $res = $this->list[$this->list->gt([5, 6, 7, 8, 9, 3, 4, 5, 6, 7])];

        $this->assertEquals((array) $res, [5, 6, 7, 8, 9]);
    }

    public function testVectorEq()
    {
        $res = $this->list[$this->list->eq([0, 5, 6, 7, 4, 3, 5, 6, 7, 8])];

        $this->assertEquals((array) $res, [0, 4]);
    }

    /**
     * Matrix
     */
    
    public function testMatrixSimpleGt()
    {
        $res = $this->matrix[$this->matrix->gt(5)];

        $this->assertEquals((array) $res, [6, 7, 8, 9, 10, 11]);
    }
}
