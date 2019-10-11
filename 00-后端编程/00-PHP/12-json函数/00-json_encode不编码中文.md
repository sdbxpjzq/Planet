# json_encode() 不编码中文

```php
echo json_encode('你好 hello'); // "\u4f60\u597d hello"
```

方法1:

`JSON_UNESCAPED_UNICODE` 选项.  php5.4+

```php
echo json_encode('你好 hello',JSON_UNESCAPED_UNICODE); // "你好 hello"

```

方法二:

先将中文字段 `urlencode`，`json_encode` 后，再用 `urldecode`，也可以显示中文。

```php
echo urldecode(json_encode(urlencode('你好 hello'))); // "你好 hello"
```

