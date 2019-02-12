`in_array`在开发中可能会不断的出现, 用不好就会出bug啦.😜

来看下边的代码:

```php
$arr = array('abc', '999');
$needle = 0;
if (in_array($needle, $arr)) {
    echo 'ok';
} else {
    echo 'not in array';
}
```

你会发现`in_array`并不是那么靠谱.

## 启动第三个参数

```php
$arr = array('abc', '999');
$needle = 0;
if (in_array($needle, $arr, true)) {
    echo 'ok';
} else {
    echo 'not in array';
}
```

## 使用`array_search`

如果找到则返回它的键，否则返回 **FALSE**。

```php

$arr = array('abc', '999');
$needle = 0;
if (array_search($needle, $arr)) {
    echo 'ok';
} else {
    echo 'not in array';
}

```

### 注意键值是`0`的情况

```php
if (array_search(1 , [ 1 ])) {
    echo 'true';
}else{
    echo 'false';
}
// 结果输出 false
```

