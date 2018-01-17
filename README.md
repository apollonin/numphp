# Numphp

[![Build Status](https://travis-ci.org/apollonin/numphp.svg?branch=master)](https://travis-ci.org/apollonin/numphp)
[![Latest Stable Version](https://poser.pugx.org/apollonin/numphp/v/stable)](https://packagist.org/packages/apollonin/numphp)
[![Total Downloads](https://poser.pugx.org/apollonin/numphp/downloads)](https://packagist.org/packages/apollonin/numphp)
[![License](https://poser.pugx.org/apollonin/numphp/license)](https://packagist.org/packages/apollonin/numphp)
[![codecov](https://codecov.io/gh/apollonin/numphp/branch/master/graph/badge.svg)](https://codecov.io/gh/apollonin/numphp)

Numphp - library for numbers manipulation. If you have array of numbers, numphp gives you an ability to do wide range of useful operations.

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
  * div = divide
  * add - add 
  * sub - subtract
  * pow - power
  * mod - mod

np_array is also has classical array behaviour. So you are able to iterate through it as usual.

**random module**

Library also provide convenient way to generate new np_arrays and populate them with random values. Available methods are

* Random::rand($size=null)
* Random::randint($low, $high=0, $size=null)

If `size` parameter is given, returns np_array with appropriate elements. Otherwise - return single random value.

## Usage examples

### Items selection

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



### Random module

**create array with random floats**

```
$result = Random::rand(5)

// result
[0.64488127438579, 0.21702189986455, 0.96931800524207, 0.78197341448719, 0.89214772632911]

```

**array with random integers**

```
$result = Random::randint(5, 15, 10);

// result
[13, 9, 12, 14, 6, 15, 8, 9, 5, 13]
```
