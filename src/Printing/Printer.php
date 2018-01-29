<?php

namespace numphp\Printing;

use numphp\np_array;

trait Printer
{
    /**
     * Printes current array as string
     * TODO. don't create new array
     * @return string 
     */
    public function __toString()
    {
        // calculate max value for whole array only once
        if ($this->level == 0)
        {
            $max = $this->max();
            $this->_max_all = $max;
            $this->subObjectsWalk(function($item) use ($max){$item->_max_all = $max;});
        }

        $result = $this->formatValues($this);

        if ($this->dimensions > 1)
            $glue = $this->level ? ", " : ",\n ";
        else
            $glue = ", ";

        return sprintf("[%s]", implode($glue, $result));
    }

    private function formatValues(np_array $data)
    {
        $result = [];

        foreach ($data as $item) {
            if ($item === true)
                $item = 'true';
            elseif($item === false)
                $item = 'false';
            elseif (is_null($item))
                $item = 'null';

            $result[] = str_pad($item, strlen($this->_max_all), ' ', STR_PAD_LEFT);
        }

        return $result;
    }

    /**
     * Walks through all sub objects and apply $f to each of them
     */
    private function subObjectsWalk(Callable $f)
    {
        foreach ($this as $item)
        {
            if ($item instanceof $this)
            {
                $f($item);
                $item->subObjectsWalk($f);
            }
        }
    }
}
