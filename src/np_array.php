<?php

namespace numphp;

use numphp\operator;

class np_array implements \ArrayAccess, \Iterator
{
    private $data;
    private $position = 0;

    public function __construct(array $data)
    {
        $this->data = $data;
        $this->position = 0;
    }

    public function __call($name, $args)
    {
        // operators call: eq, gt. gte, lt, etc...
        if (in_array($name, operator::$operators))
        {
            array_unshift($args, $this->data);
            return forward_static_call_array(['numphp\operator', $name], $args);
        }
        else
            throw new \Exception("Invalid operator");
            

        // Note: value of $name is case sensitive.
        var_dump($name, $arguments);
    }

    public function __toString()
    {
        return print_r($this->data, true);
    }

    /**
     * ArrayAccess methods
     */

    public function offsetSet($offset, $value) {
        // TODO. implement
    }

    public function offsetExists($offset) {
        return isset($this->data[$offset]);
    }

    public function offsetUnset($offset) {
        unset($this->data[$offset]);
    }

    public function offsetGet($offset) {
        if (is_array($offset))
        {
            $result = [];

            foreach ($this->getIndexes($offset) as $index)
            {
                $result[] = $this->data[$index];
            }

            return new self($result);
        }
        else
        {
            return isset($this->data[$offset]) ? $this->data[$offset] : null;
        }
    }

    private function getIndexes(array $offset)
    {
        $indexes = [];

        if (empty($offset))
            return $indexes;

        // offset is an array of indexes already
        if (!is_bool($offset[0]))
        {
            return $offset;
        }

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
    
    public function rewind() {
        $this->position = 0;
    }

    public function current() {
        return $this->offsetGet($this->position);
    }

    public function key() {
        return $this->position;
    }

    public function next() {
        ++$this->position;
    }

    public function valid() {
        return $this->offsetExists($this->position);
    }

}