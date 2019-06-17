1. 初始化连接句柄；
2. 设置CURL选项；
3. 执行并获取结果；
4. 释放VURL连接句柄。

```php
// 1. 初始化
 $ch = curl_init();
 // 2. 设置选项，包括URL
 curl_setopt($ch,CURLOPT_URL,"http://www.devdo.net");
 curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
 curl_setopt($ch,CURLOPT_HEADER,0);
 // 3. 执行并获取HTML文档内容
 $output = curl_exec($ch);
 if($output === FALSE ){
 echo "CURL Error:".curl_error($ch);
 }
 // 4. 释放curl句柄
 curl_close($ch);
```

[http://www.uxuew.cn/php/7126.html](http://www.uxuew.cn/php/7126.html)

