`in_array()`和`array_search()`默认都是松散比较，相当于`==`，所以就得到`true`。

## in_array

`in_array`在开发中可能会不断的出现, 用不好就会出bug啦.😜

来看下边的代码:

```php
// 
$arr = array('abc', '999');
$needle = 0;
if (in_array($needle, $arr)) {
    echo 'ok';
} else {
    echo 'not in array';
}
// 输出 'ok'



```

你会发现`in_array`并不是那么靠谱.

## `array_search`

如果找到则返回它的键，否则返回 **FALSE**。

```php
$arr = array('abc', '999');
$needle = 0;
$key = array_search($needle, $arr);
if (is_numeric($key)) { 
  // 键值是0的情况, 判断是否是数字 或者是 ($key !== false)
    echo 'ok';
} else {
    echo 'not in array';
}
// 输出 ok

```

## 原因

类型比较会触发类型转换, string ==> int. 而如果string类型数据第一个字符不是数字，就会转换成0。

## 解决方案

启动第三个参数,  使用强类型检查

```php
$arr = array('abc', '999');
$needle = 0;
if (in_array($needle, $arr, true)) {
    echo 'ok';
} else {
    echo 'not in array';
}
```

```php
$arr = array('abc', '999');
$needle = 0;
$key = array_search($needle, $arr, true);
if (is_numeric($key)) { // 键值是0的情况, 判断是否是数字
    echo 'ok';
} else {
    echo 'not in array';
}
```

