<?php

require_once realpath(__DIR__ . '/vendor') . '/autoload.php';

use numphp\np_array;
use numphp\operator;

$list = new np_array([18, 25, 26, 29, 30, 34]);

//iterate
echo "Init array\n";

foreach ($list as $item) {
    echo $item . " ";
}

echo "\n\n";

$res1 = $list[operator::b_and($list->gt(25), $list->lt(30))];
var_dump('res1', $res1);


$res2 = $res1[$res1->gt(27)];
var_dump('res2', $res2);

var_dump('res3', $list[2]);