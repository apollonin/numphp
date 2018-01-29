<?php

namespace Tests;

use numphp\np_array;
use numphp\Shaping\Reshaper;

class ShapingTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var np_array
     */
    private $list;

    public function setUp()
    {
        $this->list = new np_array([0, 1, 2, 3, 4, 5, 6, 7, 8, 9]);
        $this->listEven = new np_array([0, 1, 2, 3, 4, 5, 6, 7, 8]);

        $this->matrix = new np_array([[0, 1, 2, 3], [4, 5, 6, 7], [8, 9, 10, 11]]);
    }

    public function testFlatten()
    {
        $res = $this->matrix->flatten();

        $this->assertEquals((array) $res, [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]);
    }

    public function testReshape()
    {
        $res = $this->matrix->reshape([6, 2]);

        $this->assertEquals($res->getArrayCopy(), [[0, 1], [2, 3], [4, 5], [6, 7], [8, 9], [10, 11]]);
    }

    public function testReshapeInvalidShape()
    {
        $this->expectException(\Exception::class);
        
        $res = $this->matrix->reshape([1, 2]);
    }

    public function testDiagonalInvalidShape()
    {
        $this->expectException(\Exception::class);
        
        $res = $this->list->diagonal();
    }

    public function testDiagonal()
    {
        $res = $this->matrix->diagonal();

        $this->assertEquals($res->getArrayCopy(), [0, 5, 10]);
    }

    public function testDiagonalWithOffset()
    {
        $res = $this->matrix->diagonal(2);

        $this->assertEquals($res->getArrayCopy(), [2, 7]);
    }
}
