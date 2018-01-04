<?php

namespace Apollonin;

class np_array implements \ArrayAccess
{
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function gt($arg)
    {
        $result = [];

        foreach ($this->data as $index => $item)
        {
            if ($item > $arg)
                $result[] = $index;
        }

        return $result;
    }


    public function offsetSet($offset, $value) {
        //pass
    }

    public function offsetExists($offset) {
        //pass
    }

    public function offsetUnset($offset) {
        //pass
    }

    public function offsetGet($offset) {
        if (is_array($offset))
        {
            $result = [];
            foreach ($offset as $index)
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

}