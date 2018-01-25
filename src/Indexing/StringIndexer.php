<?php

namespace numphp\Indexing;

use numphp\Operator\Operators;

class StringIndexer
{
    private $str;

    public function __construct($str)
    {
        $this->str = $str;
    }

    public function convertToMethod()
    {
        $result = ['method' => '', 'arg' => ''];

        $this->normalize();

        //for the first version we accept only single operators: > 30, and so on.
        list($method, $arg) = explode(' ', $this->str);

        $result['method'] = Operators::$comparations2Symbol[$method];
        $result['arg'] = $arg;

        return $result;
    }

    private function normalize()
    {
        $str = str_replace(
                array_keys(Operators::$comparations2Symbol), 
                array_map(function($item){
                    return '  ' . $item . ' ';
                }, array_keys(Operators::$comparations2Symbol)), 
                $this->str);

        $this->str = trim(str_replace('  ',' ', $str));
    }
}
