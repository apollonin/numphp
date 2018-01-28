<?php

namespace Tests;

use numphp\np_array;

class PrinterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var np_array
     */
    private $list;

    public function setUp()
    {
        $this->list = new np_array([0, 1, 2, 3, 4, 5, 6, 7, 8, 9]);
        $this->booleanList = new np_array([true, false, true, null]);

        $this->matrix = new np_array([[1, 2, 3, 10], [4, 55, 6, 11], [7, 8, 9, 12]]);
    }

    public function testEcho()
    {
        $this->assertEquals((string) $this->list, '[0, 1, 2, 3, 4, 5, 6, 7, 8, 9]');
    }

    public function testEchoBoolean()
    {
        $this->assertEquals((string) $this->booleanList, '[true, false, true, null]');
    }

    public function testMatrix()
    {
        $this->assertEquals((string) $this->matrix, "[[1, 2, 3, 10],\n[4, 55, 6, 11],\n[7, 8, 9, 12]]");
    }
}
