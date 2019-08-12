```php
string exec ( string command [, array &output [, int &return_var]] )
```

描述：返回值保存最后的输出结果，而所有输出结果将会保存到$output数组，$return_var用来保存命令执行的状态码（用来检测成功或失败）。

```php
<?php
exec('whoami',$output, $status);
var_dump($output);
exit;

// 输出结果：

array(1) {
  [0]=>
  string(7) "hedong"
}
```

注意：
① 输出结果会逐行追加到`$output`中，因此在调用exec之前需要unset(`$output`)，特别是循环调用的时候。
② 如果想通过`exec`调用外部程序后马上继续执行后续代码，仅仅在命令里加`&`是不够的，此时`exec`依然会等待命令执行完毕；需要再将标准输出做重定向才可以，例如：

```php
exec("ls -al >/dev/null &", output, var);
```

