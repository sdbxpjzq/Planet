描述：执行给定的命令，但不返回任何输出结果，而是直接输出到显示设备上；第二个参数可选，用来得到命令执行后的状态码。

用途：当所执行的 Unix 命令输出二进制数据， 并且需要直接传送到浏览器的时候， 需要用此函数来替代 exec() 或 system() 函数

```php
<?php
passthru("whoami", $status); // 直接输出
var_dump($status); // 成功时状态码是 0
exit;

输出结果：hedong

```

