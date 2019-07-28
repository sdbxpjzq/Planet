## array_values

返回数组中所有的值并给其建立数字索引

```php
$input = ['hello' => 'world', 0 => 233, 99 => 666];
var_dump(array_values($input));
/*
Array
(
    [0] => world
    [1] => 233
    [2] => 666
)
*/

```

## array_slice

但它默认会重新排序并重置数组的**数字索引**(由第三个参数控制)，所以可以利用它重置数组中的数字索引。

```php
$input = ['hello' => 'world', 0 => 233, 99 => 666];
var_dump(array_slice($input, 0));
// 结果 ['hello' => 'world', 0 => 233, 1 => 66]
```

