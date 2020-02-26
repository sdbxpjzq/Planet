## 优点

1. 访问速度快

## 劣势

1. 不支持事务
2. 不支持外键
3. `MyISAM`删除数据后, 表的物理大小并不会减少, 产生碎片, 需要使用`optimize  table  表名`处理

## 存储文件

索引和数据分开的

1. xxx.frm  --- 表结构
2. xxx.MYD --- 数据文件
3. xxx.MYI --- 索引文件

![image-20190124205013324](https://youpaiyun.zongqilive.cn/image/006tNc79ly1fzhys457g2j31ec0pi492.jpg)

![image-20190124205216014](https://youpaiyun.zongqilive.cn/image/006tNc79ly1fzhyu97howj31jm0t6tos.jpg)