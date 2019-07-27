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

![](http://ww3.sinaimg.cn/large/006tNc79ly1g38x55r4tyj30xo0eetb4.jpg)

![](http://ww2.sinaimg.cn/large/006tNc79ly1g37pvzrwldj30tu0gxacl.jpg)

![](http://ww4.sinaimg.cn/large/006tNc79ly1g3uzd1ohcmj30z80u0gq9.jpg)





























