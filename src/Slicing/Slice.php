<?php

namespace numphp\Slicing;

use numphp\np_array;

abstract class Slice
{
    public static function isValidFormat($str)
    {
        $matches = [];

        static::matchPattern($str, $matches);

        return (bool) $matches[0];
    }

    public static function slice(np_array $data, $str)
    {
        $matches = [];

        static::matchPattern($str, $matches);

        list($start, $stop, $step) = [(int) $matches[1], (int) $matches[2], (int) $matches[3]];

        $stop = $stop?:count($data);
        $step = $step?:1;

        $result = [];

        for ($i=$start; $i < $stop; $i += $step)
        {
            $result[] = $data[$i];
        }

        return new np_array($result);
    }

    private static function matchPattern($str, &$matches)
    {
        preg_match('|^(-?\d*):?(-?\d*):?(-?\d*)|', $str, $matches);
    }
}

