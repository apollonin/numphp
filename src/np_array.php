<?php

namespace numphp;

use numphp\Operator\Operators;
use numphp\Indexing\Indexer;
use numphp\Printing\Printer;
use numphp\Statistics\Statistics;

class np_array extends \ArrayObject
{
    use Indexer, Printer, Statistics;

    private $level = 0;
    private $size = null;

    public function __construct($input = [], $flags = 0, $iterator_class = "ArrayIterator", $level = 0)
    {
        $this->level = $level;

        // convert each subarray into np_array
        if (is_array($input))
        {
            $this->size = count($input);

            foreach ($input as &$item)
            {
                if (is_array($item))
                    $item = new np_array($item, $flags, $iterator_class, ($this->level + 1));
            }
        }
        
        return parent::__construct($input, $flags, $iterator_class);
    }

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

    /**
     * Deep cloning
     * @return void 
     */
    public function __clone()
    {
        foreach ($this as &$item)
        {
            if ($item instanceof $this)
                $item = clone($item);
        }
    }

    public function __get($name)
    {
        if ($name == 'shape')
            return $this->shape();

        if ($name == 'dimensions')
            return $this->dimensions();

        throw new \Exception("Cannot access private property $" .  $name);
        
    }

    /**
     * Calculates the shape of array 
     * @return array of counts for each axis
     */
    private function shape()
    {
        $shape[] = count($this);

        if (isset($this[0]) && $this[0] instanceof np_array)
            $shape[] = $this[0]->shape()[0];
        else
            return [$this->size];

        return $shape;
    }

    /**
     * Returns count of dimensions
     * @return int 
     */
    private function dimensions()
    {
        return count($this->shape());
    }
}