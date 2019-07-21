## array_unique和array_flip

### array_unique

```php
$input = ['you are' => 666, 'i am' => 233, 'he is' => 233, 'she is' => 666];
$result = array_unique($input);
var_dump($result);
// 结果 ['you are' => 666, 'i am' => 233]
```

**array_unique()** 先将值作为字符串排序，然后对每个值只保留第一个遇到的键名，接着忽略所有后面的键名。

### array_flip



```php
$input = ['you are' => 666, 'i am' => 233, 'he is' => 233, 'she is' => 666];
$result = array_flip(array_flip($input));
var_dump($result);
// 结果 ['she is' => 666, 'he is' => 233]
```

注意:  结果和 `array_unique` 的是不一样！

如果同一个值出现多次，则最后一个键名将作为它的值，其它键会被丢弃。

总的来说就是 `array_unique` 保留第一个出现的键名，`array_flip` 保留最后一个出现的键名。

**注意**：使用 `array_flip` 作为数组去重时数组的值必须能够作为键名（即为 string 类型或 integer 类型），否则这个值将被忽略。



