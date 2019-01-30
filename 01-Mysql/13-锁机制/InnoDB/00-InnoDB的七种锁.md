InnoDB，默认的隔离级别(RR).

## 案例1

```sql
假设有数据表：
create table t(
  `id` int primary key ,
  `name` varchar(20)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


数据表中有数据：
10, zongqi
20, zhangsan
30, lisi

事务A先执行，还未提交：
insert into t values(11, xxx);

事务B后执行：
insert into t values(12, ooo); // 不会阻塞

// 尝试执行
insert into t values(11, ooo); // 阻塞了

```

不会被阻塞

## 案例2

```sql
假设有数据表：
t(id AUTO_INCREMENT, name); // id 自增

数据表中有数据：
1, shenjian
2, zhangsan
3, lisi

事务A先执行，还未提交：
insert into t(name) values(xxx);

事务B后执行：
insert into t(name) values(ooo); // 竟然没有阻塞
```

这是**自增锁（Auto-inc Locks）** 造成的现象. ![image-20190127193938500](https://ws3.sinaimg.cn/large/006tNc79ly1fzldllkfh3j30kg0bswf9.jpg)



![image-20190127193952399](https://ws2.sinaimg.cn/large/006tNc79ly1fzldltxxyzj30r20cadgo.jpg)



## 案例3

```sql
假设有数据表：
t(id unique PK, name);
 
数据表中有数据：
10, shenjian
20, zhangsan
30, lisi
 
事务A先执行，在10与20两条记录中插入了一行，还未提交：
insert into t values(11, xxx);
 
事务B后执行，也在10与20两条记录中插入了一行：
insert into t values(12, ooo); // 不阻塞
```

## InnoDB共有**七种类型的锁**



(1)共享/排它锁(Shared and Exclusive Locks)
(2)意向锁(Intention Locks)
(3)记录锁(Record Locks)
(4)间隙锁(Gap Locks)
(5)临键锁(Next-key Locks)
(6)插入意向锁(Insert Intention Locks)
(7)自增锁(Auto-inc Locks)