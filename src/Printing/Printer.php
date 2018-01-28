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
        $result = $this->formatValues($this);

        if ($this->dimensions > 1)
            $glue = $this->level ? ", " : ",\n";
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

            $result[] = $item;
        }

        return $result;
    }
}
