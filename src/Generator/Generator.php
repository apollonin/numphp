<?php

namespace numphp\Generator;

use numphp\np_array;
use numphp\Generator\Fibonacci;

abstract class Generator
{
    public static function ones($shape)
    {
        if (is_array($shape))
        {
            $result = [];

            foreach (range(1, $shape[0]) as $row)
                $result[] = array_fill(0, $shape[1], 1);

            return new np_array($result);
        }

        return new np_array(array_fill(0, $shape, 1));
    }

    public static function zeros($shape)
    {
        if (is_array($shape))
        {
            $result = [];

            foreach (range(1, $shape[0]) as $row)
                $result[] = array_fill(0, $shape[1], 0);

            return new np_array($result);
        }

        return new np_array(array_fill(0, $shape, 0));
    }

    public static function full($shape, $fill_value)
    {
        if (!is_numeric($fill_value))
            throw new \Exception("Numphp supports only number arrays");

        if (is_array($shape))
        {
            $result = [];

            foreach (range(1, $shape[0]) as $row)
                $result[] = array_fill(0, $shape[1], $fill_value);

            return new np_array($result);
        }

        return new np_array(array_fill(0, $shape, $fill_value));
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

    /**
     * Generates sequence of numbers according to passed formula
     * @param  Callable $formula number generator rule. Should return result value
     * @param  int   $start   
     * @param  int  $stop    
     * @param  int  $step    
     * @return np_array            
     */
    public static function formula(Callable $formula, $start, $stop=0, $step=1)
    {
        if (!$stop)
        {
            $stop = $start;
            $start = 0;
        }

        $result = [];

        for ($i=$start; $i < $stop; $i+= $step)
        {
            $result[] = $formula($i);
        }

        return new np_array($result);
    }

    public static function diagonal($vector)
    {
        if (is_array($vector))
            $vector = new np_array($vector);

        if ($vector->dimensions > 1)
            throw new \Exception("Except only 1-D array");

        $size = count($vector);
        $result = static::zeros([$size, $size]);

        for ($i=0; $i < $size; $i++)
        { 
            $result[$i][$i] = $vector[$i];
        }

        return $result;
            
    }
}

