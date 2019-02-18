# NULL 合并运算符
用于执行isset()检测的三元运算的快捷方式
以前写法:
```php
$site = isset($_GET['site']) ? $_GET['site'] : '菜鸟教程';

```
现在写法:
```php
$site = $_GET['site'] ?? '菜鸟教程';

```