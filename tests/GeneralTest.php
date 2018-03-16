<?php

namespace Tests;

use numphp\np_array;

class GeneralTest extends \PHPUnit\Framework\TestCase
{
    public function testCreateArray()
    {
        $res = new np_array([1, 2, 3]);

        $this->assertInstanceOf('numphp\np_array', $res);
        $this->assertEquals((array) $res, [1, 2, 3]);
    }

    public function testExceptionInvalidArg()
    {
        $this->expectException(\Exception::class);

        $res = new np_array('string');
    }

    public function testExceptionPrivateProperty()
    {
        $this->expectException(\Exception::class);

        $res = (new np_array([1]))->size;
    }
}
