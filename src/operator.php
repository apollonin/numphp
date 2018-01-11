<?php

namespace numphp;

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

    public static $operators = [
        'mul',
        'div',
        'add',
        'sub',
        'pow',
        'mod'
    ];

    public static $bitwise_operators = [
        'b_and',
        'b_or'
    ];

    public static function eq($data, $arg)
    {
        $result = [];

        array_walk($data, function($item) use (&$result, $arg){
            $result[] = $item == $arg;
        });

        return $result;
    }

    public static function gt(array $data, $arg)
    {
        $result = [];

        array_walk($data, function($item) use (&$result, $arg){
            $result[] = $item > $arg;
        });

        return $result;
    }

    public static function gte(array $data, $arg)
    {
        $result = [];

        array_walk($data, function($item) use (&$result, $arg){
            $result[] = $item >= $arg;
        });

        return $result;
    }

    public static function lt(array $data, $arg)
    {
        $result = [];

        array_walk($data, function($item) use (&$result, $arg){
            $result[] = $item < $arg;
        });

        return $result;
    }

    public static function lte(array $data, $arg)
    {
        $result = [];

        array_walk($data, function($item) use (&$result, $arg){
            $result[] = $item <= $arg;
        });

        return $result;
    }

    public static function neq(array $data, $arg)
    {
        $result = [];

        array_walk($data, function($item) use (&$result, $arg){
            $result[] = $item != $arg;
        });

        return $result;
    }


    public static function mul(array $data, $arg)
    {
        $result = [];

        foreach ($data as $item)
            $result[] = $item * $arg;

        return $result;
    }

    public static function div(array $data, $arg)
    {
        $result = [];

        foreach ($data as $item)
            $result[] = $item / $arg;

        return $result;
    }

    public static function add(array $data, $arg)
    {
        $result = [];

        foreach ($data as $item)
            $result[] = $item + $arg;

        return $result;
    }

    public static function sub(array $data, $arg)
    {
        $result = [];

        foreach ($data as $item)
            $result[] = $item - $arg;

        return $result;
    }

    public static function pow(array $data, $arg)
    {
        $result = [];

        foreach ($data as $item)
            $result[] = $item ** $arg;

        return $result;
    }

    public static function mod(array $data, $arg)
    {
        $result = [];

        foreach ($data as $item)
            $result[] = $item % $arg;

        return $result;
    }


    public static function b_and(array $a1, array $a2)
    {
        $result = [];

        foreach ($a1 as $key => $value)
        {
            $result[] = $value && $a2[$key];
        }

        return $result;
    }

    public static function b_or(array $a1, array $a2)
    {
        $result = [];

        foreach ($a1 as $key => $value)
        {
            $result[] = $value || $a2[$key];
        }

        return $result;
    }    
}