## 基本介绍

1. `mysqli`可以看做是mysql扩展的升级版本, `i-improve`
2. `mysqli`扩展的性能比`mysql`扩展要好,
3. `mysqli`扩展支持面向对象开发

![image-20190125063146490](https://ws2.sinaimg.cn/large/006tNc79ly1fzifl83ndwj312g0dwwje.jpg)

![image-20190125063447807](https://ws2.sinaimg.cn/large/006tNc79ly1fzifodkbwwj31480kgwpc.jpg)

![image-20190125064211961](https://ws4.sinaimg.cn/large/006tNc79ly1fzifw2q78wj31ja0iotiw.jpg)

![image-20190125064352182](https://ws4.sinaimg.cn/large/006tNc79ly1fzifxt72g4j315z0u0178.jpg)

![image-20190125064540579](https://ws1.sinaimg.cn/large/006tNc79ly1fzifzp2kkyj314e0nc4bm.jpg)



![image-20190125065318334](https://ws1.sinaimg.cn/large/006tNc79ly1fzig7mue4dj31aa0saqfs.jpg)

![image-20190125065422550](https://ws4.sinaimg.cn/large/006tNc79ly1fzig8qmm1uj316q0lo15a.jpg)



![image-20190125070256066](https://ws2.sinaimg.cn/large/006tNc79ly1fzighnv9fbj30te0lsn1w.jpg)



有一个思想, 尽快释放, 数据库链接. 

![image-20190126063812272](https://ws1.sinaimg.cn/large/006tNc79ly1fzjle7gntij31n00p27c8.jpg)

![image-20190126064008487](https://ws1.sinaimg.cn/large/006tNc79ly1fzjlg8t640j311e0n6tci.jpg)

![image-20190126064221220](https://ws1.sinaimg.cn/large/006tNc79ly1fzjlikz9a6j31f00m0498.jpg)







====================

![image-20190125070319128](https://ws1.sinaimg.cn/large/006tNc79ly1fzigi1llfhj31260ngdpm.jpg)

![image-20190125070215644](https://ws1.sinaimg.cn/large/006tNc79ly1fziggxt4s2j31220n8aio.jpg)



## 事务控制



```php
$mysqli = new mysqli("127.0.0.1", "my_user", "my_password", "sakila");

if ($mysqli->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
}

$mysqli->begin_transaction(MYSQLI_TRANS_START_READ_ONLY);

$mysqli->query("SELECT first_name, last_name FROM actor");
$mysqli->commit();

$mysqli->close()


```

![image-20190126131205136](https://ws1.sinaimg.cn/large/006tNc79ly1fzjws197m4j30xr0i8gqs.jpg)





## 批量执行

![image-20190126131345068](https://ws2.sinaimg.cn/large/006tNc79ly1fzjwtscttkj30og0eqdo0.jpg)

### 基本用法

![image-20190126133522549](https://ws1.sinaimg.cn/large/006tNc79ly1fzjxg9g2vbj30vu0ayjuw.jpg)

### 细节说明

![image-20190126134757884](https://ws4.sinaimg.cn/large/006tNc79ly1fzjxtdlyfyj30nh06sta8.jpg)



### 批量执行select

![image-20190126140808046](https://ws4.sinaimg.cn/large/006tNc79ly1fzjyecpawpj30ml0i7n19.jpg)

![image-20190126140833697](https://ws3.sinaimg.cn/large/006tNc79ly1fzjyeskhuej30ys0880v2.jpg)





















