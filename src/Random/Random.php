<?php

namespace numphp\Random;

use numphp\np_array;

abstract class Random
{
    public static function rand($size = 0)
    {
        if ($size < 0)
            throw new Exception("size value must be greater than 0");
            
        if (!$size)
            return static::getRandFloat();

        $list = [];

        for ($i=0; $i < $size; $i++)
            $list[] = static::getRandFloat();

        return new np_array($list);
    }

    public static function randint($low, $high = 0, $size = 0)
    {
        if ($size < 0)
            throw new Exception("size value must be greater than 0");
        
        if (!$high)
        {
            $size = $high;
            $high = $low;
            $low = 0;
        }

        // return single value
        if (!$size)
            return rand($low, $high);

        $list = [];

        for ($i=0; $i < $size; $i++)
            $list[] = rand($low, $high);

        return new np_array($list);
            
    }

    private static function getRandFloat()
    {
        return mt_rand() / mt_getrandmax();
    }
}

