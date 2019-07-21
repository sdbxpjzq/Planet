```php
array array_filter ( array $array [, callable $callback [, int $flag = 0 ]] )
```

参数说明:

- `callback`

  如果没有提供 `callback` 函数， 将删除 `array` 中所有等值为 **FALSE** 的条目

  

```php
$entry = array(  
    0 => 'foo',  
    1 => false,  
    2 => -1,  
    3 => NULL,  
    4 => ''
);
print_r(array_filter($entry));
/*
Array   
(   
    [0] => foo   
    [2] => -1   
)
*/

```

