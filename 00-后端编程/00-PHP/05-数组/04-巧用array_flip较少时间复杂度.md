```php

$arr1 = ['假设他有100万个元素'];
$arr2 = ['假设他有100万个元素'];
$arr3 = [];
foreach ($arr1 as $v) {
    $k = array_search($v, $arr2);
    if ($k === false) {
        $arr3[] = $v;
    }
}

```

上面的时间复杂度O(n²).

使用`array_filp`处理, 把arr2的key和value 互换一下

```php
$arr1 = ['假设他有100万个元素'];
$arr2 = array_filp(['假设他有100万个元素']);
$arr3 = [];
foreach ($arr1 as $v) {
    if (isset($arr2[$v])) {
        $arr3[] = $v;
    }
}

```

由于hashmap的时间复杂度是O(1) ~ O(n)（大多数时候都是1），所以这个实现的时间复杂度O(n)



