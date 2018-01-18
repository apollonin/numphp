<?php

namespace numphp;

use numphp\operator;
use numphp\StringIndexator;

class np_array implements \ArrayAccess, \Iterator
{
    private $data;
    private $position = 0;

    public function __construct(array $data)
    {
        $this->data = $data;
        $this->position = 0;
    }

    public function __call($method, $args)
    {
        // comparations call: eq, gt. gte, lt, etc...
        // math operations call: add, sub, div, etc...
        if (in_array($method, operator::$comparations) || in_array($method, operator::$operators))
        {
            array_unshift($args, $this);
            return new self(forward_static_call_array(['numphp\operator', $method], $args));
        }
        else
            throw new \Exception("Invalid operator: " . $method);
    }


    public function __toString()
    {
        return sprintf("[%s]", implode(", ", $this->data));
    }

    public function getData()
    {
        return $this->data;
    }

    /**
     * ArrayAccess methods
     */

    public function offsetSet($offset, $value) 
    {
        if (is_null($offset)) 
        {
            $this->data[] = $value;
        } 
        else 
        {
            if (is_array($offset) || $offset instanceof $this)
            {
                foreach ($this->getIndexes($offset) as $index)
                {
                    $this->data[$index] = $value;
                }
            }
            else
            {
                $this->data[$offset] = $value;
            }
        }
    }

    public function offsetExists($offset) 
    {
        return isset($this->data[$offset]);
    }

    public function offsetUnset($offset) 
    {
        unset($this->data[$offset]);
    }

    public function offsetGet($offset) 
    {
        if (is_array($offset) || $offset instanceof $this)
        {
            $result = [];

            foreach ($this->getIndexes($offset) as $index)
            {
                $result[] = $this->data[$index];
            }

            return new self($result);
        }
        elseif(is_numeric($offset))
        {
            return $this->data[$offset];
        }
        else
        {
            $stringIndexator = new StringIndexator($offset);
            $callee = $stringIndexator->convertToMethod();

            return $this->{$callee['method']}($callee['arg']);
        }
    }

    /**
     * Get array indexes according to conditions
     * @param  mixed  $offset could be array of indexes or array of booleans
     * @return array         
     */
    private function getIndexes($offset)
    {
        $indexes = [];

        // no offset - no indexes
        if (empty($offset))
            return [];

        // offset is an array of indexes already
        if (!is_bool($offset[0]))
            return $offset;

        // convert mask array to array of indexes
        foreach ($offset as $index => $value)
        {
            if ($value)
                $indexes[] = $index;
        }
        
        return $indexes;
    }


    /**
     * Iterator methods
     */
    
    public function rewind() 
    {
        $this->position = 0;
    }

    public function current() 
    {
        return $this->offsetGet($this->position);
    }

    public function key() 
    {
        return $this->position;
    }

    public function next() 
    {
        ++$this->position;
    }

    public function valid() 
    {
        return $this->offsetExists($this->position);
    }

}