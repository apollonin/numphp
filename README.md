# Numphp

[![Build Status](https://travis-ci.org/apollonin/numphp.svg?branch=master)](https://travis-ci.org/apollonin/numphp)
[![Latest Stable Version](https://poser.pugx.org/apollonin/numphp/v/stable)](https://packagist.org/packages/apollonin/numphp)
[![Total Downloads](https://poser.pugx.org/apollonin/numphp/downloads)](https://packagist.org/packages/apollonin/numphp)
[![License](https://poser.pugx.org/apollonin/numphp/license)](https://packagist.org/packages/apollonin/numphp)
[![codecov](https://codecov.io/gh/apollonin/numphp/branch/master/graph/badge.svg)](https://codecov.io/gh/apollonin/numphp)
[![Maintainability](https://api.codeclimate.com/v1/badges/9cda6d0e7e7967900ff2/maintainability)](https://codeclimate.com/github/apollonin/numphp/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/9cda6d0e7e7967900ff2/test_coverage)](https://codeclimate.com/github/apollonin/numphp/test_coverage)

Numphp is a library for manipulating numbers. If you have array of numbers, numphp gives you an ability to do wide range of useful operations.

Contributions as highly appreciated.

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
  * eq - equals
  * gt - greater than
  * gte - greater than or equals
  * lt - less than
  * lte - less than or equals
  * neq - not equals
* get items by conditions
  * b_and - logical AND
  * b_or - logical OR
* set items values according to conditions. Conditions are the same as for selection.
* apply math operations to whole array
  * mul - multiply
  * div - divide
  * add - add 
  * sub - subtract
  * pow - power
  * mod - mod
* Get slice of array

np_array is also has classical array behaviour. So you are able to iterate through it as usual.

**random module**

Library also provide convenient way to generate new np_arrays and populate them with random values. Available methods are

* rand
* randint

If `size` parameter is given, returns np_array with appropriate elements. Otherwise - return single random value.

**generators**

For quick stub array creation you may use convenient predefined methods

* ones - creates array full of 1
* zeros - creates array full of 0 
* full- creates array full of provided fill_value
* arange - creates evenly spaced values within a given interval.


## Usage examples

### Indexing

**create new array**
```
$list = new np_array([18, 25, 26, 30, 34]);
```

**get items by their indexes**

```
$result = $list[[2,3]];

// result
[26, 29]
```

To get item as single value - pass index as single value as well

```
$result = $list[1];

// result
25
```

**get items by condition**

```
$result = $list[$list->gt(25)];

// result
[26, 29, 30, 34]
```

You may also access index by string representations of comparison. 

```
// gives the same result as above
$result = $list[$list['> 25']];
```


**get items by conditions**

*b_and* - "bitwise" and

```
$resuilt = $list[operator::b_and($list->gt(25), $list->lt(30))];

// result
[26, 29]
```

**array-like behaviour**

You may also iterate your np_array object as usual

```
foreach ($list as $item) {
    echo $item . " ";
}

// output
18 25 26 29 30 34
```


### Slicing

You may get slices of your np_array in a very convenient way. Just pass string formatted like `start:[stop][:step]` as index and you'll get result.

```
$result = $list['1:3'];

//result
[25, 26]


$result = $list['1:5:2'];

//result
[25, 30]
```

You can even skip `stop` and `step` values, which means: get all items from `start` to the end of array.

```
$result = $list['1:'];

//result
[25, 26, 29, 30, 34]
``` 

You may even skip `start` value, than will be considered as 0 in this case

```
$result = $list[':'];

//result
[18, 25, 26, 29, 30, 34]
```

Negative `start` or `stop` means indexes count from the end of array

```
$result = $list['-3:5'];

//result
[29, 30]
```


### Set items values

**set items by indexes**

```
$result = clone($list);
$result[[2,3]] = 9999;

// result
[18, 25, 9999, 9999, 30, 34]
```

**set items by conditions**

```
$result = clone($list);
$result[$result->gte(30)] = 9999;

// result
[18, 25, 26, 29, 9999, 9999]
```

**adding new items**

Of course, you may add new items as usual

```
$result = clone($list);
$result[] = 9999;

// result 
[18, 25, 26, 29, 30, 34, 9999]
```

### Math operations

You are able to apply certain math operation to whole array. It will apply to each element.

```
$result = $list->add(100);

// result 
[118, 125, 126, 129, 130, 134]
```

You may also perform math operation under two np_arrays

```
$result = $list->add(new np_array([1, 2, 3, 4, 5]))

//result
[19, 27, 29, 34, 39]
```

Or event np_array and normal array!

```
$result = $list->add([1, 2, 3, 4, 5]);

//result
[19, 27, 29, 34, 39]
```



### Random module

**create array with random floats**

```
use numphp\Random\Random;

$result = Random::rand(5)

// result
[0.64488127438579, 0.21702189986455, 0.96931800524207, 0.78197341448719, 0.89214772632911]

```

**array with random integers**

```
use numphp\Random\Random;

$result = Random::randint(5, 15, 10);

// result
[13, 9, 12, 14, 6, 15, 8, 9, 5, 13]
```


### Generators module

**create array full of zeros, ones or fill_value**

```
use numphp\Generator\Generator;

$result = Generator::zeros(5);

//result
[0, 0, 0, 0, 0]


$result = Generator::ones(5);

//result
[1, 1, 1, 1, 1]

$result = Generator::full(5, 9999);

//result
[9999, 9999, 9999, 9999, 9999]
```

**create array within a range and given interval**

```
use numphp\Generator\Generator;

$result = Generator::arange(1, 15, 2);

//result
[1, 3, 5, 7, 9, 11, 13]
```