# Numphp

[![Build Status](https://travis-ci.org/apollonin/numphp.svg?branch=master)](https://travis-ci.org/apollonin/numphp)
[![Latest Stable Version](https://poser.pugx.org/apollonin/numphp/v/stable)](https://packagist.org/packages/apollonin/numphp)
[![Total Downloads](https://poser.pugx.org/apollonin/numphp/downloads)](https://packagist.org/packages/apollonin/numphp)
[![License](https://poser.pugx.org/apollonin/numphp/license)](https://packagist.org/packages/apollonin/numphp)
[![codecov](https://codecov.io/gh/apollonin/numphp/branch/master/graph/badge.svg)](https://codecov.io/gh/apollonin/numphp)
[![Maintainability](https://api.codeclimate.com/v1/badges/9cda6d0e7e7967900ff2/maintainability)](https://codeclimate.com/github/apollonin/numphp/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/9cda6d0e7e7967900ff2/test_coverage)](https://codeclimate.com/github/apollonin/numphp/test_coverage)

Numphp is a library for manipulating numbers. If you have an array of numbers, numphp gives you an ability to do wide range of useful operations.

Contributions are highly appreciated.

## Installation

### Via composer

```
composer require apollonin/numphp
```


## Available features

**arrays**

* get item by index
* get items by array of indexes
* get items by condition
  * eq, gt, gte, lt, lte, neq - equals, greater than, and so on
* get items by complex conditions
  * b_and, b_or - bitwise AND and OR
* set items values according to conditions, indexes or slices
* apply math operations to whole array
  * mul, div, add, sub, pow, mod
* get slice of array
* get statistical values from array
  * count, max, mean, median, min, sum
  * describe - special method that displays all above values
* Get dimensional data
  * shape
  * dimension

np_array also has classical array behaviour. So you are able to iterate through it as usual.

**matrix**

Matrix - is a special case of arrays. Full support for n-dimensional matrix is on the way. So, currently I can guaratnee 2d matrix support.

You are able to perform all the same operations and comparisons as with arrays. Refer to Matrix section below in usage examples.

**dimensional manipulation**

You are able to change dimensions for existed array or matrix. Use `flatten` or `reshape` methods.

**random module**

Numphp also provides convenient ways to generate new np_arrays and populate them with random values. Available methods are

* rand
* randint

If `size` parameter is given, returns np_array with appropriate elements. Otherwise, it returns single random value.

**generators**

For quick stub array creation you may use these convenient predefined methods

* ones - creates array full of 1
* zeros - creates array full of 0 
* full- creates array full of provided fill_value
* arange - creates evenly spaced values within a given interval.
* fib - creates Fibonacci numbers
* formula - returns sequence of numbers, based on provided formula


## Usage examples

### Indexing

**create new array**
```php
$list = new np_array([0, 1, 2, 3, 4, 5, 6, 7, 8, 9]);
```

**get items by their indexes**

```php
$result = $list[[2,3]];

// result
[2, 3]
```

To get item as single value - pass index as single value as well

```php
$result = $list[1];

// result
1
```

**get items by condition**

```php
$result = $list[$list->gt(5)];

// result
[6, 7, 8, 9]
```

You may also access index by string representations of comparison. 

```php
// gives the same result as above
$result = $list[$list['> 5']];
```

> Important note about conditional indexing

Conditional operator returns masking array

```php
  $mask = $list->gt(5);

  // mask
  [false, false, false, false, false, false, true, true, true, true]

  // and then
  $result = $list[$mask];

  // result 
  [6, 7, 8, 9]
```

You also can pass another array as an argument. In this case the comparison will be applied for each element respectively.

```php
$result = $list[$list->gt([5, 6, 7, 8, 9, 3, 4, 5, 6, 7])];

// result
[6, 7, 8, 9]
```


**get items by conditions**

*b_and* - "bitwise" and

```php
$resuilt = $list[Bitwise::b_and($list->gte(5), $list->lt(8))];

// result
[5, 6, 7]
```

**array-like behaviour**

You may also iterate your np_array object as usual

```php
foreach ($list as $item) {
    echo $item . " ";
}

// output
0 1 2 3 4 5 6 7 8 9
```


### Slicing

You may get slices of your np_array in a very convenient way. Just pass string formatted like `start:[stop][:step]` as index and you'll get result.

```php
$result = $list['1:5'];

//result
[1, 2, 3, 4]


$result = $list['1:5:2'];

//result
[1, 3]
```

You can even skip `stop` and `step` values, which means: get all items from `start` to the end of array.

```php
$result = $list['1:'];

//result
[1, 2, 3, 4, 5, 6, 7, 8, 9]
``` 

You may even skip `start` value; it will be considered as 0 in this case

```php
$result = $list[':'];

//result
[0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
```

Negative `start` or `stop` means indexes count from the end of array

```php
$result = $list['-7:6'];

//result
[3, 4, 5]
```


### Set items values

**set items by indexes**

```php
$result = clone($list);
$result[[2,3]] = 999;

// result
[0, 1, 999, 999, 4, 5, 6, 7, 8, 9]
```

**set items by conditions**

```php
$result = clone($list);
$result[$result->gte(5)] = 999;

// result
[0, 1, 2, 3, 4, 999, 999, 999, 999, 999]
```

**set items by slice**

```php
$result = clone($list);
$result['1:3'] = 999;

// result
[0, 999, 999, 3, 4, 5, 6, 7, 8, 9]
```

**adding new items**

Of course, you may add new items as usual

```php
$result = clone($list);
$result[] = 999;

// result 
[0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 999]
```

### Math operations

You are able to apply certain math operations to the whole array. It will apply to each element.

```php
$result = $list->add(100);

// result 
[100, 101, 102, 103, 104, 105, 106, 107, 108, 109]
```

You may also perform math operation under two np_arrays

```php
$result = $list->add(new np_array([0, 1, 2, 3, 4, 5, 6, 7, 8, 9]))

//result
[0, 2, 4, 6, 8, 10, 12, 14, 16, 18]
```

Or event np_array and normal array!

```php
$result = $list->add([0, 1, 2, 3, 4, 5, 6, 7, 8, 9]);

//result
[0, 2, 4, 6, 8, 10, 12, 14, 16, 18]
```



### Random module

**create array with random floats**

```php
use numphp\Random\Random;

$result = Random::rand(5)

// result
[0.64488127438579, 0.21702189986455, 0.96931800524207, 0.78197341448719, 0.89214772632911]

```

**array with random integers**

```php
use numphp\Random\Random;

$result = Random::randint(5, 15, 10);

// result
[13, 9, 12, 14, 6, 15, 8, 9, 5, 13]
```


### Generators module

**create array full of zeros, ones or fill_value**

```php
use numphp\Generator\Generator;

$result = Generator::zeros(5);

//result
[0, 0, 0, 0, 0]


$result = Generator::ones(5);

//result
[1, 1, 1, 1, 1]

$result = Generator::full(5, 999);

//result
[999, 999, 999, 999, 999]
```

**create array within a range and given interval**

```php
use numphp\Generator\Generator;

$result = Generator::arange(1, 15, 2);

//result
[1, 3, 5, 7, 9, 11, 13]
```

**generate N [Fibonacci](https://en.wikipedia.org/wiki/Fibonacci_number) numbers**

```php
use numphp\Generator\Generator;

$result = Generator::fib(6);

//result
[1, 1, 2, 3, 5, 8]
```


**generate numbers according to formula**

Provide [callable](http://php.net/manual/en/language.types.callable.php) as a first argument. It must return value, that will be used in sequence.

```php
use numphp\Generator\Generator;

$result = Generator::formula(function($n){return 2*$n+1;}, 1, 5);

//result
[3, 5, 7, 9]
```

**generate matrix with given diagonal**

```
$matrix = Generator::diagonal([5, 3, 1]);

// matrix
[[5, 0, 0],
[0, 3, 0],
[0, 0, 1]]
```


### Matrix operations

Generally the syntax and features are the same as for arrays

**creation**

```
$matrix = new np_array([[0, 1, 2, 3], [4, 5, 6, 7], [8, 9, 10, 11]]);

// matrix
[[ 0,  1,  2,  3],
 [ 4,  5,  6,  7],
 [ 8,  9, 10, 11]]
```

**indexing**

Indexing is done in respect to X-axis (rows)

```
$result = $matrix[0];

//result
[0, 1, 2, 3]
```

**slicing**

```
$result = $matrix['1:3'];

//result
[[ 4,  5,  6,  7],
 [ 8,  9, 10, 11]]
```

**comparisons**

```
$result = $matrix[$matrix->gt(5)];

//result
[6, 7, 8, 9, 10, 11]
```

Keep in mind 'masking' feature

```
$mask = $matrix->gt(5);

//mask 
[[false, false, false, false],
[false, false, true, true],
[true, true, true, true]]
```

**changing values**

```
$matrix[$matrix->gte(5)] = 999;

//matrix
[[  0,   1,   2,   3],
 [  4, 999, 999, 999],
 [999, 999, 999, 999]]
```

**math operations**

```
$result = $matrix->mul(5);

//result
[[ 0,  5, 10, 15],
 [20, 25, 30, 35],
 [40, 45, 50, 55]]
```

**get shape of matrix**

```
$shape = $matrix->shape;

//shape: [rows, cols]
[3, 4]
```

And if you just need count of dimensions

```
$dimensions = $matrix->dimensions;

//dimensions
2
```


**diagonal**

```
$result = $matrix->diagonal();

//result 
[0, 5, 10]

```

or you can set offset for diagonal

```
$result = $matrix->diagonal(2);

//result 
[2, 7]

```

## Changing dimensions

**flatten matrix**

You can get 1-D array from matrix.

```
$result = $matrix->flatten();

//result
[0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
```

**Reshaping**

You also can change current shape of matrix to any desired.

```
$result = $matrix->reshape([6, 2]);

//result
[[ 0,  1],
 [ 2,  3],
 [ 4,  5],
 [ 6,  7],
 [ 8,  9],
 [10, 11]]
```
