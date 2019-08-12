```php
string shell_exec( string command)
```

描述：通过 shell 环境执行命令，并且将完整的输出以字符串的方式返回。

```php
<?php
$output = shell_exec('whoami');
echo "$output"; // hedong
exit;
```

注意：

当进程执行过程中发生错误，或者进程不产生输出的情况下，都会返回 NULL， 所以，使用本函数无法通过返回值检测进程是否成功执行。 如果需要检查进程执行的退出码，请使用 exec() 函数。

