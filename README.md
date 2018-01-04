# Numphp

Numphp - designed to be as convenient as [numpy](http://www.numpy.org/).

Contributions as highly appreciated.

### example of usage

```
$list = new np_array([18, 25, 26, 30, 34]);
```

**get items by their indexes**

```
$result = $list[[2,3]];

// result
array(2) {
  [0]=>
  int(26)
  [1]=>
  int(30)
}
```

**get items by condition**

```
$result = $list[$list->gt(25)];

// result
array(3) {
  [0]=>
  int(26)
  [1]=>
  int(30)
  [2]=>
  int(34)
}
```


**get items by conditions**

*b_and* - "bitwise" and

```
$resuilt = $list[operator::b_and($list->gt(25), $list->lt(30))];

// result
array(1) {
  [0]=>
  int(26)
}
```

*b_or* - "bitwise" or

```
$resuilt = $list[operator::b_or($list->gt(25), $list->lt(25))];

// result
array(4) {
  [0]=>
  int(18)
  [1]=>
  int(26)
  [2]=>
  int(30)
  [3]=>
  int(34)
}
```

