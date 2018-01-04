# Numphp

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