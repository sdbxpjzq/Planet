

如果某个URL请求需要基于 HTTP 的身份验证，你可以使用下面的代码：

```php
$url = "http://www.somesite.com/members/";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// 发送用户名和密码
curl_setopt($ch, CURLOPT_USERPWD, "myusername:mypassword");
// 你可以允许其重定向
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
// 下面的选项让 cURL 在重定向后
// 也能发送用户名和密码
curl_setopt($ch, CURLOPT_UNRESTRICTED_AUTH, 1);
$output = curl_exec($ch);
curl_close($ch);
```

