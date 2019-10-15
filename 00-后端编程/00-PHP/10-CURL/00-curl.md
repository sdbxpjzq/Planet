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





## post请求

```php
public static function aSendPost(string $url, array $postData)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
        ));
  			// 不验证https证书
       	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  			// 不返回header头信息
        curl_setopt($ch, CURLOPT_HEADER, false);
  			// 返回内容不直接输出
  		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_URL, $url);
        // post数据
        curl_setopt($ch, CURLOPT_POST, 1);
        // post的变量
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        $output = curl_exec($ch);
        return is_array($output) ? $output : json_decode($output, true);
    }


```

## 检查错误

```php
// ...
$output = curl_exec($ch);
if ($output === FALSE) { // 注意是  === 
    echo "cURL Error: " . curl_error($ch);
}
// ...

```

请注意，比较的时候我们用的是`=== FALSE`，而非`== FALSE`。因为我们得区分 空输出 和 布尔值FALSE，后者才是真正的错误。



[http://www.uxuew.cn/php/7126.html](http://www.uxuew.cn/php/7126.html)

