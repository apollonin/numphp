<?php

namespace numphp\Generator;

use numphp\np_array;

abstract class Generator
{
    public static function ones($size)
    {
        return new np_array(array_fill(0, $size, 1));
    }

    public static function zeros($size)
    {
        return new np_array(array_fill(0, $size, 0));   
    }

    public static function full($size, $fill_value)
    {
        if (!is_numeric($fill_value))
            throw new \Exception("Numphp supports only number arrays");
            
        return new np_array(array_fill(0, $size, $fill_value));
    }

    public static function arange($start, $stop=0, $step=1)
    {
        if (!$stop)
        {
            $stop = $start;
            $start = 0;
        }

        $result = [];

        for ($i=$start; $i < $stop; $i+= $step)
        {
            $result[] = $i;
        }

        return new np_array($result);
    }
}

