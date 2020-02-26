## 连接数据库

如果有任何连接错误，将抛出一个 `PDOException `异常对象

```php
try {
    $dsn = 'mysql:host=127.0.0.1;dbname=zongqi;port=3306;charset=utf8';
    $user = 'zroot';
    $pass = 'root';
    $pdo = new PDO($dsn, $user, $pass);
} catch(PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
```

![](https://youpaiyun.zongqilive.cn/image/20200226122259.png)



