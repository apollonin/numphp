<?php

require_once realpath(__DIR__ . '/../vendor') . '/autoload.php';

use numphp\np_array;

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


/**
 * Math operations
 */

echo 'multiply all to 5: ' . "\n" . $matrix->mul(5) . "\n\n";

/** Statistics **/

echo 'max element is: ' . "\n" . $matrix->max() . "\n\n";
