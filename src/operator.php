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


    public static function mul(np_array $data, $arg)
    {
        $result = [];

        foreach ($data as $item)
            $result[] = $item * $arg;

        return $result;
    }

    public static function div(np_array $data, $arg)
    {
        $result = [];

        foreach ($data as $item)
            $result[] = $item / $arg;

        return $result;
    }

    public static function add(np_array $data, $arg)
    {
        $result = [];

        foreach ($data as $item)
            $result[] = $item + $arg;

        return $result;
    }

    public static function sub(np_array $data, $arg)
    {
        $result = [];

        foreach ($data as $item)
            $result[] = $item - $arg;

        return $result;
    }

    public static function pow(np_array $data, $arg)
    {
        $result = [];

        foreach ($data as $item)
            $result[] = $item ** $arg;

        return $result;
    }

    public static function mod(np_array $data, $arg)
    {
        $result = [];

        foreach ($data as $item)
            $result[] = $item % $arg;

        return $result;
    }


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