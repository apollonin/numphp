# Numphp

Numphp - library for numbers manipulation. If you have array of numbers, numphp gives you an ability to do wide range of useful operations.

Contributions as highly appreciated.

## Available features


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

np_array is also has classical array behaviour. So you are able to iterate through it as usual.

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
Array
(
    [0] => 26
    [1] => 29
)
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
Array
(
    [0] => 26
    [1] => 29
    [2] => 30
    [3] => 34
)
```


**get items by conditions**

*b_and* - "bitwise" and

```
$resuilt = $list[operator::b_and($list->gt(25), $list->lt(30))];

// result
Array
(
    [0] => 26
    [1] => 29
)
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
$newList = clone($list);
$newList[[2,3]] = 9999;

// result
Array
(
    [0] => 18
    [1] => 25
    [2] => 9999
    [3] => 9999
    [4] => 30
    [5] => 34
)
```

**set items by conditions**

```
$newList = clone($list);
$newList[$newList->gte(30)] = 9999;

// result
Array
(
    [0] => 18
    [1] => 25
    [2] => 26
    [3] => 29
    [4] => 9999
    [5] => 9999
)
```

**adding new items**

Of course, you may add new items as usual

```
$newList = clone($list);
$newList[] = 9999;

// result 
Array
(
    [0] => 18
    [1] => 25
    [2] => 26
    [3] => 29
    [4] => 30
    [5] => 34
    [6] => 9999
)
```