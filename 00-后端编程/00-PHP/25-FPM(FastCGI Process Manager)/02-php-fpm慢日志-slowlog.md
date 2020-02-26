如果一个php网站可以访问，就是访问速度变慢了,可以通过php-fpm的慢执行日志，清晰的了解到php的脚本哪里执行时间长，它可以定位到具体的代码行

```shell
vim /usr/local/php/etc/php-fpm.d/www.conf

request_slowlog_timeout = 1 //超时时间

slowlog = /usr/local/php/var/log/www-slow.log

重启php-fpm /etc/init.d/php-fpm reload


```

我在php文件中加了一行



```php
sleep(3);
```

日志内容

![](https://youpaiyun.zongqilive.cn/image/006tKfTcly1g0csyzlptxj30l6030wek.jpg)

