<?php

namespace numphp\Operator;

use numphp\np_array;

abstract class Operators
{
    public static $comparations = [
        'eq', 
        'gt',
        'gte',
        'lt',
        'lte',
        'neq'
    ];

    public static $comparations2Symbol = [
        '==' => 'eq',
        '>'  => 'gt',
        '>=' => 'gte',
        '<'  => 'lt',
        '<=' => 'lte',
        '!=' => 'neq',
    ];

    public static $operators = [
        'add',
        'div',
        'mod',
        'mul',
        'pow',
        'sub',
    ];

    /**
     * Comparison module
     */

    public static function eq(np_array $data, $arg)
    {
        self::checkArg($data, $arg, $isScalar);

        $result = [];

        foreach ($data as $index => $item)
            if ($item instanceof np_array)
                $result[] = self::eq($item, $arg);
            else
                $result[] = $item == $arg[$isScalar?0:$index];

        return $result;
    }

    public static function gt(np_array $data, $arg)
    {
        self::checkArg($data, $arg, $isScalar);

        $result = [];

        foreach ($data as $index => $item)
            if ($item instanceof np_array)
                $result[] = self::gt($item, $arg);
            else
                $result[] = $item > $arg[$isScalar?0:$index];

        return $result;
    }

    public static function gte(np_array $data, $arg)
    {
        self::checkArg($data, $arg, $isScalar);

        $result = [];

        foreach ($data as $index => $item)
            if ($item instanceof np_array)
                $result[] = self::gte($item, $arg);
            else
                $result[] = $item >= $arg[$isScalar?0:$index];

        return $result;
    }

    public static function lt(np_array $data, $arg)
    {
        self::checkArg($data, $arg, $isScalar);

        $result = [];

        foreach ($data as $index => $item)
            if ($item instanceof np_array)
                $result[] = self::lt($item, $arg);
            else
                $result[] = $item < $arg[$isScalar?0:$index];

        return $result;
    }

    public static function lte(np_array $data, $arg)
    {
        self::checkArg($data, $arg, $isScalar);

        $result = [];

        foreach ($data as $index => $item)
            if ($item instanceof np_array)
                $result[] = self::lte($item, $arg);
            else
                $result[] = $item <= $arg[$isScalar?0:$index];

        return $result;
    }

    public static function neq(np_array $data, $arg)
    {
        self::checkArg($data, $arg, $isScalar);
        
        $result = [];

        foreach ($data as $index => $item)
            if ($item instanceof np_array)
                $result[] = self::neq($item, $arg);
            else
                $result[] = $item != $arg[$isScalar?0:$index];

        return $result;
    }


    /**
     * Math module
     */
    
    public static function add(np_array $data, $arg)
    {
        self::checkArg($data, $arg, $isScalar);

        $result = [];

        foreach ($data as $index => $item)
            if ($item instanceof np_array)
                $result[] = self::add($item, $arg);
            else
                $result[] = $item + $arg[$isScalar?0:$index];

        return $result;
    }

    public static function div(np_array $data, $arg)
    {
        self::checkArg($data, $arg, $isScalar);

        $result = [];

        foreach ($data as $index => $item)
            if ($item instanceof np_array)
                $result[] = self::div($item, $arg);
            else
                $result[] = $item / $arg[$isScalar?0:$index];

        return $result;
    }

    public static function mod(np_array $data, $arg)
    {
        self::checkArg($data, $arg, $isScalar);

        $result = [];

        foreach ($data as $index => $item)
            if ($item instanceof np_array)
                $result[] = self::mod($item, $arg);
            else
                $result[] = $item % $arg[$isScalar?0:$index];

        return $result;
    }

    public static function mul(np_array $data, $arg)
    {
        self::checkArg($data, $arg, $isScalar);

        $result = [];

        foreach ($data as $index => $item)
            if ($item instanceof np_array)
                $result[] = self::mul($item, $arg);
            else
                $result[] = $item * $arg[$isScalar?0:$index];
            

        return $result;
    }

    public static function pow(np_array $data, $arg)
    {
        self::checkArg($data, $arg, $isScalar);

        $result = [];

        foreach ($data as $index => $item)
            if ($item instanceof np_array)
                $result[] = self::pow($item, $arg);
            else
                $result[] = $item ** $arg[$isScalar?0:$index];

        return $result;
    }

    public static function sub(np_array $data, $arg)
    {
        self::checkArg($data, $arg, $isScalar);

        $result = [];

        foreach ($data as $index => $item)
            if ($item instanceof np_array)
                $result[] = self::sub($item, $arg);
            else
                $result[] = $item - $arg[$isScalar?0:$index];

        return $result;
    }

    /**
     * Checks provided arg and cast it to np_array class object
     * @param  np_array $data      source array
     * @param  mixed   &$arg      numeric, array or np_array
     * @param  boolean  &$isScalar true if provided 1 element for operator (scalar or array with 1 element)
     * @return void              
     */
    private static function checkArg(np_array $data, &$arg, &$isScalar=false)
    {
        $arg = self::formatArg($arg)->flatten();
        
        $isScalar = (count($arg) == 1);
    }

    /**
     * Convert arg to np_array
     * @param  mixed $arg 
     * @return np_array      
     */
    private static function formatArg($arg)
    {
        if (is_numeric($arg))
            return new np_array([$arg]);

        if (is_array($arg))
            return new np_array($arg);

        if (is_object($arg) && $arg instanceof np_array)
            return $arg;

        // unknown arg format
        throw new \Exception("Operators accept only numbers, array or np_arrays as second argument");
    }
}