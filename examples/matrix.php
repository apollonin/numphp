<?php

require_once realpath(__DIR__ . '/../vendor') . '/autoload.php';

use numphp\np_array;
use numphp\Generator\Generator;

$matrix = new np_array([[0, 1, 2, 3], [4, 5, 6, 7], [8, 9, 10, 11]]);

echo 'Matrix is: ' . "\n" . $matrix . "\n\n";

echo 'Shape is: ' . "\n" . '(' . implode(', ', $matrix->shape) . ')' . "\n\n";

/**
 * Indexing
 */

echo 'matrix[0]: ' . "\n" . $matrix[0] . "\n\n";

echo 'matrix["1:3"]: ' . "\n" . $matrix['1:3'] . "\n\n";

echo 'mask > 5: ' . "\n" . $matrix->gt(5) . "\n\n";

echo 'matrix > 5: ' . "\n" . $matrix[$matrix->gt(5)] . "\n\n";


/**
 * Set items
 */

$res5 = clone($matrix);
$res5[[[3], [3], [3]]] = 999;
echo 'set whole 4th column to 999: ' . "\n" . $res5 . "\n\n";

$res6 = clone($matrix);
$res6[$res6->gte(5)] = 999;
echo 'set elements >= 5 to 999: ' . "\n" . $res6 . "\n\n";

/** Generator **/

echo 'zeros array with size of [5, 2]: ' . "\n" . Generator::zeros([5, 2]) . "\n\n";
echo 'ones array with size of [5, 3]: ' . "\n" . Generator::ones([5, 3]) . "\n\n";

echo 'arange with reshaping to [2, 7]: ' . "\n" . Generator::arange(1, 15)->reshape([2, 7]) . "\n\n";

echo 'matrix with [5, 3, 1] diagonal: ' . "\n" . Generator::diagonal([5, 3, 1]) . "\n\n";

/**
 * Math operations
 */

echo 'multiply to 5: ' . "\n" . $matrix->mul(5) . "\n\n";
echo 'add [999, 999, 999, 999]: ' . "\n" . $matrix->add([999, 999, 999, 999]) . "\n\n";
echo 'add matrix of ones: ' . "\n" . $matrix->add(Generator::ones([3, 4])) . "\n\n";

/** Statistics **/

echo 'max element is: ' . "\n" . $matrix->max() . "\n\n";

echo 'describe ' . print_r($matrix->describe(), true) . "\n\n";


/**
 * Shaping
 */

echo 'flatten: ' . "\n" . $matrix->flatten() . "\n\n";

echo 'reshape to [6, 2]: ' . "\n" . $matrix->reshape([6, 2]) . "\n\n";

echo 'diagonal is: ' . "\n" . $matrix->diagonal() . "\n\n";