<?php

namespace numphp\Shaping;

use numphp\np_array;

trait Reshaper
{
    /**
     * Flatten matrix to make it 1-D array
     * @return np_array 
     */
    public function flatten()
    {
        $result = [];

        $arrayCopy = $this->getArrayCopy();

        array_walk_recursive($arrayCopy, function($item) use (&$result) {
           $result[] = $item;
        });

        return new np_array($result);
    }

    /**
     * Change shape of the array
     * TODO. improve solution to use recursive algo for any size dimensions
     * @param  array  $size 
     * @return np_array       
     */
    public function reshape(array $size)
    {
        $flatten = $this->flatten();

        if (count($flatten) != $size[0] * $size[1])
            throw new \Exception('Cannot reshape array of size '. count($flatten) .' into shape (' . implode(', ', $size) . ')');

        $result = [];
        $level = 0;

        for ($i=0; $i < $size[0]; $i++)
        {
            $result[$level] = [];
            for ($j=0; $j < $size[1]; $j++)
            {
                $result[$level][] = current($flatten);
                next($flatten);
            }
            $level++;
        }

        return new np_array($result);
    }

    public function diagonal($offset = 0)
    {
        if ($this->dimensions < 2)
            throw new \Exception("Diagonal requires an array of at least two dimensions");

        $result = [];

        foreach ($this as $level => $row)
        {
            $index = $level + $offset;
            
            if (!isset($row[$index]))
                break;

            $result[] = $row[$index];
        }

        return new np_array($result);
    }
}
