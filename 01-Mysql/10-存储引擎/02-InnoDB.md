## 优点

1. 支持事务
2. 支持外键
3. 并发性好, 行级锁
4. 比起`MyISAM`, `InnoDB`写的处理效率差一些, 并且会占用更多的磁盘空间以保留数据和索引.

## 存储文件

Innodb 只有2个文件,  数据和索引在一起

1. xxx.frm --- 表结构

2. xxx.ibd --- 索引 + 数据



![image-20190124210102329](https://ws4.sinaimg.cn/large/006tNc79ly1fzhz3d4wx5j315y0pgain.jpg)



![image-20190124210304649](https://ws3.sinaimg.cn/large/006tNc79ly1fzhz5iekm8j312s0qwdou.jpg)







