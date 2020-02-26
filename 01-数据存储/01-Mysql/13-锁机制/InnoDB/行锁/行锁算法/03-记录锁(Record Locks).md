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





























