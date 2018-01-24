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
        $result = [];

        foreach ($this as $item) {
            if ($item === true)
                $item = 'true';
            elseif($item === false)
                $item = 'false';
            elseif (is_null($item))
                $item = 'null';

            $result[] = $item;
        }
        return sprintf("[%s]", implode(", ", $result));
    }
}
