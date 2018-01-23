<?php

namespace numphp\Generator;

use numphp\np_array;
use numphp\Generator\Fibonacci;

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

    /**
     * Generates n first elements in Fibonacci numbers
     * @param  int $n 
     * @return np_array    
     */
    public static function fib($n)
    {
        if ($n < 0)
            throw new \Exception("N should be positive number");
            
        $generator = Fibonacci::generate();
    
        $result = [];
        for ($i=0; $i < $n; $i++) { 
            $result[] = $generator->current();
            $generator->next();
        }

        return new np_array($result);
    }
}

