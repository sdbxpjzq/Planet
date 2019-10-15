PHP 自带有 FTP 类库， 但你也能用 cURL：

```php
// 开一个文件指针
$file = fopen("/path/to/file", "r");
// url里包含了大部分所需信息
$url = "ftp://username:password@mydomain.com:21/path/to/new/file";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// 上传相关的选项
curl_setopt($ch, CURLOPT_UPLOAD, 1);
curl_setopt($ch, CURLOPT_INFILE, $fp);
curl_setopt($ch, CURLOPT_INFILESIZE, filesize("/path/to/file"));
// 是否开启ASCII模式 (上传文本文件时有用)
curl_setopt($ch, CURLOPT_FTPASCII, 1);
$output = curl_exec($ch);
curl_close($ch);
```

