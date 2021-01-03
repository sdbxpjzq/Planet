## LBCC

`Lock Based Concurrency  Control`

在读取数据前, 对其加锁, 阻止其他事务对数据进行修改



## MVCC

`Multi Version  Concurrency Control`

生成一个数据请求时间点的一直性数据快照(Snapshot), 并用这个快照来提供一定级别的一致性读取.

==MVCC最大的好处：读不加锁，读写不冲突==

**在MVCC并发控制中，读操作可以分成两类：**

1. 快照读 (snapshot read)：读取的是记录的可见版本 (有可能是历史版本)，不用加锁（共享读锁s锁也不加，所以不会阻塞其他事务的写）。



2 当前读 (current read)：读取的是记录的最新版本，并且，当前读返回的记录，都会加上锁，保证其他事务不会再并发修改这条记录。

​	`select .. lock in share mode`

​	`select … for update`

​	update, delete, insert



