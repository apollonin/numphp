<?php

require_once realpath(__DIR__ . '/vendor') . '/autoload.php';

use numphp\np_array;
use numphp\Operator\Bitwise;
use numphp\Random\Random;
use numphp\Generator\Generator;

$list = new np_array([0, 1, 2, 3, 4, 5, 6, 7, 8, 9]);

//iterate
echo "Init array\n";

foreach ($list as $item) {
    echo $item . " ";
}

echo "\n\n";

/**
 * Indexing
 */

echo 'mask >= 5' . "\n" . $list->gte(5) . "\n\n";
echo 'mask >= 5 (explicit)' . "\n" . $list->mask('> 5') . "\n\n";

$res1 = $list[Bitwise::b_and($list->gte(5), $list->lt(8))];
echo '>= 5 and < 8: ' . "\n" . $res1 . "\n\n";

echo 'previous > 5: ' . "\n" . $res1[$res1->gt(5)] . "\n\n";

echo 'index 2: ' . "\n" . $list[2] . "\n\n";

echo 'equal 5: ' . "\n" . $list[$list->eq(5)] . "\n\n";

echo 'short indexing < 5: ' . "\n" . $list[$list['< 5']] . "\n\n";

/**
 * Set items
 */

$res5 = clone($list);
$res5[[2,3]] = 999;
echo 'set indexes 2 and 3 to 999: ' . "\n" . $res5 . "\n\n";

$res6 = clone($list);
$res6[$res6->gte(5)] = 999;
echo 'set elements >= 5 to 999: ' . "\n" . $res6 . "\n\n";


/**
 * Math operations
 */

echo 'multiply all to 5: ' . "\n" . $list->mul(5) . "\n\n";

echo 'power > 5 by 2: ' . "\n" . $list[$list->gt(5)]->pow(2) . "\n\n";

echo 'add 5' . "\n" . $list->add(5) . "\n\n";
echo 'add vector [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]' . "\n" . ($list->add(Generator::arange(10))) . "\n\n";



/** 
*  Random
**/

echo 'random count 0: ' . "\n" . Random::rand() . "\n\n";

echo 'random count 5: ' . "\n" . Random::rand(5) . "\n\n";

echo 'random 10 ints within range 5-15: ' . "\n" . Random::randint(5, 15, 10) . "\n\n";


/** Generator **/

echo 'zeros array with size of 5: ' . "\n" . Generator::zeros(5) . "\n\n";
echo 'ones array with size of 5: ' . "\n" . Generator::ones(5) . "\n\n";

echo 'arange: ' . "\n" . Generator::arange(1, 15) . "\n\n";

echo 'formula 2n+1 from 1 to 5' . "\n" . Generator::formula(function($n){return 2*$n+1;}, 1, 5) . "\n\n";




/** Slicing **/

echo 'slicing [1:5]: ' . "\n" . $list['1:5'] . "\n\n";
echo 'slicing [1:5:2]: ' . "\n" . $list['1:5:2'] . "\n\n";
echo 'slicing [1:]: ' . "\n" . $list['1:'] . "\n\n";

//negative
echo 'slicing [-7:6]: ' . "\n" . $list['-7:6'] . "\n\n";





/**
 * Matrix
 */

$matrix = new np_array([[1, 2, 3], [4, 5, 6], [7, 8, 9]]);

echo $matrix;

/** Statistics **/

echo 'sum is: ' . "\n" . $list->sum() . "\n\n";
echo 'mean is: ' . "\n" . $list->mean() . "\n\n";

echo 'describe ' . print_r($list->describe(), true) . "\n\n";

