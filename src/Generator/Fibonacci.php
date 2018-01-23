<?php

namespace numphp\Generator;

class Fibonacci
{
    public static function generate()
    {
        $curr = 1;
        $prev = 0;

        while(true)
        {
            yield $curr;

            $next = $curr + $prev;
            $prev = $curr;
            $curr = $next;
        }
    }
}