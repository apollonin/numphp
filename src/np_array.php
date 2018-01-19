<?php

namespace numphp;

use numphp\operator;
use numphp\StringIndexator;

#class np_array implements \ArrayAccess, \Iterator, \Countable
class np_array extends \ArrayObject
{
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
        return sprintf("[%s]", implode(", ", (array) $this));
    }

    /**
     * ArrayAccess methods
     */

    public function offsetSet($offset, $value) 
    {
        if (is_array($offset) || $offset instanceof $this)
        {
            foreach ($this->getIndexes($offset) as $index)
            {
                parent::offsetSet($index, $value);
            }
        }
        else
        {
            parent::offsetSet($offset, $value);
        }
    }

    public function offsetGet($offset) 
    {
        if (is_array($offset) || $offset instanceof $this)
        {
            $result = [];

            foreach ($this->getIndexes($offset) as $index)
            {
                $result[] = parent::offsetGet($index);
            }

            return new self($result);
        }
        elseif(is_numeric($offset))
        {
            return parent::offsetGet($offset);
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

}