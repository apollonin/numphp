<?php

namespace Tests;

use numphp\np_array;
use numphp\operator;

class IndexingTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var np_array
     */
    private $list;

    public function setUp()
    {
        $this->list = new np_array([18, 25, 26, 30, 34]);
    }

    public function testSimpleIndex()
    {
        $res = $this->list[2];

        $this->assertEquals($res, 26);
    }

    public function testArrayIndex()
    {
        $res = $this->list[[3,4]];

        $this->assertEquals((array) $res, [30, 34]);
    }

    public function testConditionIndex()
    {
        $res = $this->list[$this->list->gte(25)];

        $this->assertEquals((array) $res, [25, 26, 30, 34]);
    }

    
}
