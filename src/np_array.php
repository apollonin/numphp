<?php

namespace numphp;

use numphp\operator;

class np_array implements \ArrayAccess, \Iterator
{
    private $data;
    private $position = 0;

    public function __construct(array $data)
    {
        $this->vector = $data;
        $this->position = 0;
    }

    public function __call($method, $args)
    {
        // operators call: eq, gt. gte, lt, etc...
        if (in_array($method, operator::$operators))
        {
            array_unshift($args, $this->vector);
            return forward_static_call_array(['numphp\operator', $method], $args);
        }
        else
            throw new \Exception("Invalid operator");
    }

    public function __toString()
    {
        return print_r($this->vector, true);
    }

    /**
     * ArrayAccess methods
     */

    public function offsetSet($offset, $value) 
    {
        if (is_null($offset)) 
        {
            $this->vector[] = $value;
        } 
        else 
        {
            if (is_array($offset))
            {
                foreach ($this->getIndexes($offset) as $index)
                {
                    $this->vector[$index] = $value;
                }
            }
            else
            {
                $this->vector[$offset] = $value;
            }
        }
    }

    public function offsetExists($offset) 
    {
        return isset($this->vector[$offset]);
    }

    public function offsetUnset($offset) 
    {
        unset($this->vector[$offset]);
    }

    public function offsetGet($offset) 
    {
        if (is_array($offset))
        {
            $result = [];

            foreach ($this->getIndexes($offset) as $index)
            {
                $result[] = $this->vector[$index];
            }

            return new self($result);
        }
        else
        {
            return $this->vector[$offset];
        }
    }

    /**
     * Get array indexes according to conditions
     * @param  array  $offset could be array of indexes or array of booleans
     * @return array         
     */
    private function getIndexes(array $offset)
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