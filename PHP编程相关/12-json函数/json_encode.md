# json_encode强制转对象

## 代码示例

```php
$tmp = array('a','b','c');
echo json_encode($tmp);
```

结果:

`['a','b','c']`

```php
$tmp = array('a'=>'a','b'=>'b','c'=>'c');
echo json_encode($tmp);
```

`{"a":"a","b":"b","c":"c"}`


```php
$tmp3 = [];
$a =  json_encode($tmp3);
print_r($a); // []
```


> **索引数组本来就是连贯的，应该是除了索引数组，其他数组（关联数组，多维数组）都会被编码为object。**

## 解决办法

`json_encode($tmp, JSON_FORCE_OBJECT) `

不管在什么情况，接口永远输出对象，空数据及为`{}`

# 参考

http://php.net/manual/zh/json.constants.php