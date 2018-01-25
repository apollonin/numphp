<?php

namespace numphp\Operator;

use numphp\np_array;

abstract class Bitwise
{
    public static $bitwise_operators = [
        'b_and',
        'b_or'
    ];

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