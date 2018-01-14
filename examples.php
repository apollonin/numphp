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
echo 'res1: ' . $res1;


$res2 = $res1[$res1->gt(27)];
echo 'res2: ' . $res2;

echo 'res3: ' . $list[2] . "\n";

$res4 = $list[$list->eq(26)];
echo 'res4: ' . $res4;


$res5 = clone($list);
$res5[[2,3]] = 9999;
echo 'res5: ' . $res5;

$res6 = clone($list);
$res6[$res6->gte(30)] = 9999;
echo 'res6: ' . $res6;

$res7 = $list->mul(5);
echo 'res7: ' . $res7;

$res8 = $list[$list->gt(29)]->pow(2);
echo 'res8: ' . $res8;


echo 'res9: ' . $list[$list['< 30']];

