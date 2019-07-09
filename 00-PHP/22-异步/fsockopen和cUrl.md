## fsockopen

```php
$fp = fsockopen("www.example.com", 80, $errno, $errstr, 30);
if (!$fp) die('error fsockopen');
stream_set_blocking($fp,0);
$http = "GET /save.php  / HTTP/1.1\r\n";    
$http .= "Host: www.example.com\r\n";    
$http .= "Connection: Close\r\n\r\n";
fwrite($fp,$http);
fclose($fp);
```

## cURL

利用cURL中的`curl_multi_*`函数发送异步请求

```php
$cmh = curl_multi_init();
$ch1 = curl_init();
curl_setopt($ch1, CURLOPT_URL, "http://localhost:6666/child.php");
curl_multi_add_handle($cmh, $ch1);
curl_multi_exec($cmh, $active);
echo "End\n";
```

