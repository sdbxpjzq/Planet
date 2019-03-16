## 说明

面向InnoDb存储引擎, 开销大, 加锁慢, 会出现死锁

锁定的颗粒度最小, 发生锁冲突的概率最低, 并发也最高.

Innodb与MyISAM的最大不同有2点:

1. 支持事务
2. 采用行级锁

## 基本演示

![](https://ws1.sinaimg.cn/large/006tNc79ly1fzmjrgt9s9j30to0chjst.jpg)

## 索失效引行锁升级为表锁



![](https://ws2.sinaimg.cn/large/006tNc79ly1fzmkf3o5gij30tw0d6q44.jpg)



## 行锁的3种算法

- `Record Lock`：单个行记录上的锁。
- `Gap Lock`：间隙锁，锁定一个范围，但不包含记录本身。
- `Next-Key Lock`：`Gap Lock`+`Record Lock`，锁定一个范围，并且锁定记录本身。(非唯一索引,  但是不是所有索引都会加上Next-key Lock的，**在查询的列是唯一索引（包含主键索引）的情况下，Next-key Lock会降级为Record Lock。**)

`Record Lock`总是会去锁住索引记录，如果InnoDB存储引擎表在建立的时候没有设置任何一个索引，那么这时InnoDB存储引擎会使用隐式的主键来进行锁定。



![](https://ws2.sinaimg.cn/large/006tKfTcly1g14oczr0maj312108mtbh.jpg)



### 触发Next-Key Lock

#### 非唯一索引

```sql

create table t2
(
  `a` int ,
  index a(a)
) ENGINE = InnoDB;

insert into t2 select 1;
insert into t2 select 3;
insert into t2 select 5;
insert into t2 select 7;
insert into t2 select 10;

```

session A

下边的执行会生成一个间隙锁 , (1,3)(3,5)

```sql
start transaction;
select * from t2 where a=3 for update ;

```

session B

下边的运行会被阻塞.

```sql
insert into t2 select 2;
insert into t2 select 4;

```

#### 唯一索引多列组成

```sql
create table t2
(
  `a` int ,
  `b` int ,
  primary key a_b(a,b)
) ENGINE = InnoDB;

insert into t2 select 1,2;
insert into t2 select 3,6;
insert into t2 select 5,10;
insert into t2 select 7, 14;
insert into t2 select 10, 18;

```

session A

GAP范围 [a:3, b:6] 到 [a:7, b:14]

```sql
start transaction;
// 命中索引
select * from t2 where a=5 for update ;
```







todo 参考

https://mp.weixin.qq.com/s/V9nuZ-TNSI_avMVbCd1T7Q























