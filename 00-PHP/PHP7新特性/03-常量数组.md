在 PHP 5.6 中仅能通过 const 定义常量数组，PHP 7 可以通过 define() 来定义。

```php
// 使用 define 函数来定义数组
define('sites', [
   'Google',
   'Runoob',
   'Taobao'
]);

print(sites[1]);
```

