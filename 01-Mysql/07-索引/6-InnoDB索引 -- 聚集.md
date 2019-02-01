数据文件本身就是索引文件

表数据文件本身就是按`B+Tree`组织的一个索引结构文件

聚集索引- 叶子节点包含了玩曾的数据记录

`InnoDB`表必须有主键, 并且推荐使用整型自增的主键

非主键索引结构,叶子节点存储的是主键值, 为了数据的一致性+节省存储空间

## 主键索引

![](https://ws4.sinaimg.cn/large/006tNc79ly1fzql2kde0fj31cm0iq770.jpg)

## 非主键索引

![image-20190131182401127](https://ws4.sinaimg.cn/large/006tNc79ly1fzpxw2qw50j312u0g645a.jpg)

> 非主键索引叶子节点存储主键值

![image-20190131185518069](/Users/zongqi/Library/Application Support/typora-user-images/image-20190131185518069.png)



## 为什么推荐使用整型的自增主键?

若是自增的, 会直接往`B+Tree`后边追加, 

无序的话, 就有可能造成原有已经存好的出现分裂现象, 造成数据迁移,造成磁盘碎片



