  该函数会创建一个管道，所以不会对PHP造成阻塞。但异步是有条件的，需要在command后面加上“&”，表示后台执行，另外如果使用fread来读取管道数据，将会造成进程阻塞。

`b.php`

```php
echo "start curl\n";
        //popen函数，参数1执行php命令(PHP的路径 需要执行的php命令文件或其他shell命令)，参数2以只读方式执行命令
        $sFilePath = __DIR__.'/a.php';
        pclose(popen("/usr/local/php/bin/php  {$sFilePath} &", 'r'));
        echo "end curl\n";
```

`a.php`

```php
for ($i = 0; $i < 10; $i++) {
            file_put_contents(__DIR__ . '/zongqi.txt', $i, FILE_APPEND);
            sleep(1);
        }
```

