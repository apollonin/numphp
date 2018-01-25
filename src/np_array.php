<?php

namespace numphp;

use numphp\Operator\Operators;
use numphp\Indexing\Indexer;
use numphp\Printing\Printer;
use numphp\Statistics\Statistics;

class np_array extends \ArrayObject
{
    use Indexer, Printer, Statistics;

    public function __call($method, $args)
    {
        // comparations call: eq, gt. gte, lt, etc...
        // math operations call: add, sub, div, etc...
        if (in_array($method, Operators::$comparations) || in_array($method, Operators::$operators))
        {
            array_unshift($args, $this);
            return new self(forward_static_call_array(['numphp\Operator\Operators', $method], $args));
        }
        else
            throw new \Exception("Invalid operator: " . $method);
    }
}