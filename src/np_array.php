<?php

namespace numphp;

class np_array implements \ArrayAccess
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function gt($arg)
    {
        $result = [];

        array_walk($this->data, function($item) use (&$result, $arg){
            $result[] = $item > $arg;
        });

        return $result;
    }

    public function lt($arg)
    {
        $result = [];

        array_walk($this->data, function($item) use (&$result, $arg){
            $result[] = $item < $arg;
        });

        return $result;
    }


    public function offsetSet($offset, $value) {
        //pass
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

            return $result;
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

}