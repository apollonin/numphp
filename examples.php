<?php

require_once realpath(__DIR__ . '/vendor') . '/autoload.php';

use numphp\np_array;
use numphp\operator;
use numphp\Random\Random;

$list = new np_array([18, 25, 26, 29, 30, 34]);

//iterate
echo "Init array\n";

foreach ($list as $item) {
    echo $item . " ";
}

echo "\n\n";

$res1 = $list[operator::b_and($list->gt(25), $list->lt(30))];
echo '>= 25 and < 30: ' . "\n" . $res1 . "\n\n";


$res2 = $res1[$res1->gt(27)];
echo 'previous > 27: ' . "\n" . $res2 . "\n\n";

echo 'index 2: ' . "\n" . $list[2] . "\n\n";

$res4 = $list[$list->eq(26)];
echo 'equal 26: ' . "\n" . $res4 . "\n\n";


$res5 = clone($list);
$res5[[2,3]] = 9999;
echo 'set indexes 2 and 3 to 9999: ' . "\n" . $res5 . "\n\n";

$res6 = clone($list);
$res6[$res6->gte(30)] = 9999;
echo 'set elements >= 30 to 9999: ' . "\n" . $res6 . "\n\n";

$res7 = $list->mul(5);
echo 'multiply all to 5: ' . "\n" . $res7 . "\n\n";

$res8 = $list[$list->gt(29)]->pow(2);
echo 'power > 29 by 2: ' . "\n" . $res8 . "\n\n";


echo 'short indexing < 30: ' . "\n" . $list[$list['< 30']] . "\n\n";



/** 
*  Random
**/

echo 'random count 0: ' . "\n" . Random::rand() . "\n\n";

echo 'random count 5: ' . "\n" . Random::rand(5) . "\n\n";

echo 'random 10 ints within range 5-15: ' . "\n" . Random::randint(5, 15, 10) . "\n\n";


