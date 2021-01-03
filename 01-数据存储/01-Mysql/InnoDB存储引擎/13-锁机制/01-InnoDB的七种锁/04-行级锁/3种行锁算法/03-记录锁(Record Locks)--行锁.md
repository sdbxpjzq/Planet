（1）记录锁, 仅仅锁住索引记录的一行，在单条索引记录上加锁。
（2）record lock锁住的永远是索引，而非记录本身，即使该表上没有任何索引，那么innodb会在后台创建一个隐藏的聚集主键索引，那么锁住的就是这个隐藏的聚集主键索引。
所以说当一条sql没有走任何索引时，那么将会在每一条聚合索引后面加X锁，这个类似于表锁，但原理上和表锁应该是完全不同的。





记录锁,  单个行记录上的锁。

总是会去锁住索引记录，如果InnoDB存储引擎表在建立的时候没有设置任何一个索引，那么这时InnoDB存储引擎会使用隐式的主键来进行锁定。



```sql
create table t2
(
    `id`   int not null primary key ,
    `name` varchar(100) not null default ''
);
insert into t2 values (1,'1'),(4, '4'), (7, '7'), (10, '10');

```

![](https://youpaiyun.zongqilive.cn/image/20200226120946.png)

![](https://youpaiyun.zongqilive.cn/image/20200226120959.png)

![](https://youpaiyun.zongqilive.cn/image/20200226121019.png)





























