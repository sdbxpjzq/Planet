## 优点

1. 支持事务

2. 支持外键

3. 并发性好, 行级锁

4. 比起`MyISAM`, `InnoDB`写的处理效率差一些, 并且会占用更多的磁盘空间以保留数据和索引.

   

## 存储文件

Innodb 只有2个文件,  数据和索引在一起

1. xxx.frm --- 表结构

2. xxx.ibd --- 索引 + 数据



![image-20190124210102329](https://youpaiyun.zongqilive.cn/image/006tNc79ly1fzhz3d4wx5j315y0pgain.jpg)



![image-20190124210304649](https://youpaiyun.zongqilive.cn/image/006tNc79ly1fzhz5iekm8j312s0qwdou.jpg)





## 体系架构
## 体系架构

### 后台线程

是多线程模型, 在后台有多个不同的后台线程

Master  Thread

是一个非常核心的后台线程. 主要负责将缓冲池的数据异步刷新到磁盘, 保证数据的一致性, 包括脏页的刷新, 合并插入缓冲(insert buffer), undo页的回收

IO Thread

使用AIO(Async  IO)来处理写IO请求, 提高数据库性能

Purge Thread

事务被提交之后, 其所使用的undolog 可能不再需要, 因此需要Purge Thread来回收已经使用并分配的undo页.

page Clear Thread

将之前版本中脏页的刷新操作放入到单独的线程中来完成,目的是为了减轻原Master Thread 的工作及对于用户查询线程的阻塞, 进一步提高性能.

### 缓冲池

为了弥补CPU和磁盘的速度的鸿沟, 引入了缓冲池

对于数据库中页的修改操作，首先修改缓冲池上的页，然后按一定的频率刷新到磁盘。

和磁盘上数据不一致的页，成为脏页。

![](https://youpaiyun.zongqilive.cn/image/006tKfTcly1g0ynk9r4ppj30u00c2dge.jpg)

每次一个页上的数据发生修改就刷新到磁盘，这个开销非常大，但是如果不是每次一有脏页就刷新到磁盘上，那么发生宕机的时候，将会发生数据丢失，故引入“`重做日志redo-log`”

`Write Ahead Log`，先写重做日志，再修改页(缓存池)。

当发生宕机而导致数据丢失的时候, 通过重做日志来完成数据的恢复.

解决的问题:

1. 缩短数据库的恢复时间
2. 缓冲池不够时, 将脏页刷新到磁盘
3. 重做日志不可用时, 刷新脏页

当数据库发生宕机, 数据库不需要重新做s所有的日志, 因为checkpoint之前的页都已经刷新回磁盘.数据库只需对checkpoint后的重做日志进行恢复, 这样就大大缩短了恢复的时间

#### **Checkpoint技术**

将缓冲池中的脏页刷新到磁盘



#### LRU

LRU列表中还加入了`midpoint`位置, 最新读取到的页并不是直接放入到LRU列表的首部,而是放入到LRU列表的`midpoint`位置.

由参数`innodb_old_blocks_pct`控制, 默认值是37.表示新读取的页插入到LRU列表尾端的37%的位置.

old列表: midpoint之后的列表

new列表: midpoint之前的列表(new 列表中的页都是最为活跃的热点数据)



这个算法在InnoDB存储引擎下称为`midpoint insertion strategy`

### InnoDB关键特征

插入缓存

二次写

自适应哈希索引

异步IO

刷新邻接页

## 日志文件

错误日志-error log

慢查询日志 - slow query log

查询日志 -log



### 二进制日志-binlog

记录了对MySQL数据库执行更改的所有操作. 但是不包括`select`和`show`这类操作,因为这类操作对数据本身并没有修改.

作用:

恢复(recovery) , 

复制, 主从同步

审计

### redolog



### undo log

Undo log是InnoDB MVCC事务特性的重要组成部分。当我们对记录做了变更操作时就会产生undo记录，Undo记录默认被记录到系统表空间(ibdata)中，但从5.6开始，也可以使用独立的Undo 表空间.

Undo记录中存储的是老版本数据，当一个旧的事务需要读取数据时，为了能读取到老版本的数据，需要顺着undo链找到满足其可见性的记录

为了保证事务并发操作时，在写各自的undo log时不产生冲突，InnoDB采用回滚段的方式来维护undo log的并发写入和持久化。回滚段实际上是一种 Undo 文件组织方式，每个回滚段又有多个undo log slot



### pid文件

mysql实例启动的时候,会将自己的进程ID写入一个文件中,该文件为pid文件























































