代码1

```php
set_time_limit(5);
sleep(10);
echo "done" . "\n";
```

上述代码会显示"done"，说明set_time_limit(5)也没生效.

代码2

```php
set_time_limit(5);
while(true==true){}
sleep(10);
echo "done" . "\n";
```

上述代码运行出错, 运行超时，set_time_limit(5)生效了。

`Fatal error: Maximum execution time of 5 seconds`

## 原因

原来set_time_limit()只控制到脚本自身的执行时间按，而系统调用如system() 、流操作、数据库查询操作等都不计算在内。

第一段代码、第二段代中的`sleep`是系统调用，所以不计算在内。按这个解释，第一段代码还是会执行到结束的，就是除系统调用外的时间累加到了`5s`。







