<?php

namespace numphp;

use numphp\np_array;

abstract class operator
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

    public static $bitwise_operators = [
        'b_and',
        'b_or'
    ];

    /**
     * Comparison module
     */

    public static function eq(np_array $data, $arg)
    {
        $result = [];

        foreach ($data as $item)
            $result[] = $item == $arg;

        return $result;
    }

    public static function gt(np_array $data, $arg)
    {
        $result = [];

        foreach ($data as $item)
            $result[] = $item > $arg;

        return $result;
    }

    public static function gte(np_array $data, $arg)
    {
        $result = [];

        foreach ($data as $item)
            $result[] = $item >= $arg;

        return $result;
    }

    public static function lt(np_array $data, $arg)
    {
        $result = [];

        foreach ($data as $item)
            $result[] = $item < $arg;

        return $result;
    }

    public static function lte(np_array $data, $arg)
    {
        $result = [];

        foreach ($data as $item)
            $result[] = $item <= $arg;

        return $result;
    }

    public static function neq(np_array $data, $arg)
    {
        $result = [];

        foreach ($data as $item)
            $result[] = $item != $arg;

        return $result;
    }


    /**
     * Math module
     */
    
    public static function add(np_array $data, $arg)
    {
        self::checkArg($data, $arg, $isSingle);

        $result = [];

        foreach ($data as $index => $item)
            $result[] = $item + $arg[$isSingle?0:$index];

        return $result;
    }

    public static function div(np_array $data, $arg)
    {
        self::checkArg($data, $arg, $isSingle);

        $result = [];

        foreach ($data as $index => $item)
            $result[] = $item / $arg[$isSingle?0:$index];

        return $result;
    }

    public static function mod(np_array $data, $arg)
    {
        self::checkArg($data, $arg, $isSingle);

        $result = [];

        foreach ($data as $index => $item)
            $result[] = $item % $arg[$isSingle?0:$index];

        return $result;
    }

    public static function mul(np_array $data, $arg)
    {
        self::checkArg($data, $arg, $isSingle);

        $result = [];

        foreach ($data as $index => $item)
            $result[] = $item * $arg[$isSingle?0:$index];

        return $result;
    }

    public static function pow(np_array $data, $arg)
    {
        self::checkArg($data, $arg, $isSingle);

        $result = [];

        foreach ($data as $index => $item)
            $result[] = $item ** $arg[$isSingle?0:$index];

        return $result;
    }

    public static function sub(np_array $data, $arg)
    {
        self::checkArg($data, $arg, $isSingle);

        $result = [];

        foreach ($data as $index => $item)
            $result[] = $item - $arg[$isSingle?0:$index];

        return $result;
    }

    /**
     * Checks provided arg and cast it to np_array class object
     * @param  np_array $data      source array
     * @param  mixed   &$arg      numeric, array or np_array
     * @param  boolean  &$isSingle true if provided 1 element for operator
     * @return void              
     */
    private static function checkArg(np_array $data, &$arg, &$isSingle=false)
    {
        if (is_numeric($arg))
            $arg = new np_array([$arg]);
        elseif (is_array($arg))
            $arg = new np_array($arg);
        elseif(is_object($arg) && !$arg instanceof np_array)
            throw new \Exception("Operators accept only numbers, array or np_arrays as second argument");
            
        if (count($arg) != 1 && count($arg) != count($data))
            throw new \Exception("Can not perform operation between vectors with shapes " . count($data) . " and " . count($arg));
            
        $isSingle = (count($arg) == 1);
    }


    /**
     * 'Bitwise' operators
     */

    public static function b_and(np_array $a1, np_array $a2)
    {
        $result = [];

        foreach ($a1 as $key => $value)
            $result[] = $value && $a2[$key];

        return $result;
    }

    public static function b_or(np_array $a1, np_array $a2)
    {
        $result = [];

        foreach ($a1 as $key => $value)
            $result[] = $value || $a2[$key];

        return $result;
    }    
}