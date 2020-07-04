## 临键锁(Next-Key Locks)

1. record lock + gap lock, 左开右闭区间。
2. 默认情况下，innodb使用next-key locks来锁定记录。select … for update
3. 但当查询的索引含有唯一属性的时候，Next-Key Lock 会进行优化，将其降级为Record Lock，即仅锁住索引本身，不是范围。
4. Next-Key Lock在不同的场景中会退化:![](https://youpaiyun.zongqilive.cn/image/20200704103252.png)

5. 









**InnoDB默认的行锁算法**



`Gap Lock`+`Record Lock`，锁定一个范围，并且锁定记录本身。(非唯一索引,  但是不是所有索引都会加上Next-key Lock的，**在查询的列是唯一索引（包含主键索引）的情况下，Next-key Lock会降级为Record Lock。**)



```sql
# 表
create table t2
(
    `id`   int not null primary key ,
    `name` varchar(100) not null default ''
);
insert into t2 values (1,'1'),(4, '4'), (7, '7'), (10, '10');

```

`session`

```sql
begin ;
select * from t2 where id > 5 and id< 9 for update ;
```

`session2`

```sql
begin;
select * from t2 where id=4 for update ; # 正常
insert into t2 values (5,'5'); # 阻塞
insert into t2 values (6,'6'); # 阻塞
insert into t2 values (8,'8'); # 阻塞
select * from t2 where id=10 for update ; # 阻塞
```

![](https://youpaiyun.zongqilive.cn/image/20200226121048.png)





临键锁是间隙锁和记录锁的结合，配合使用防止幻读的发生

假设 有表person，字段有id, name。隔离级别为 Repeatable read。

表内容：

| id   | name |
| ---- | ---- |
| 2    | Ray  |
| 7    | Mike |

id 为主键或唯一键：

`update person set name = ‘XX’ where id > 5`

临键锁锁住的区域为：

(5,7]

(7,正无穷]



