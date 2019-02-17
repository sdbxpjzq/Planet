## mkdir

`bool mkdir ( string $pathname [, int $mode = 0777 [, bool $recursive = false [, resource ​$context ]]] )`

`mkdir`默认只能一级一级的创建目录

```php
$dir = './a/b/c';
echo mkdir($dir); // Warning: mkdir(): No such file or directory

```

正确的方式, 启动第三个参数`$recursive`,设置为`true`, 递归创建

```php
$dir = './a/b/c';
echo mkdir($dir,0777, true);
```