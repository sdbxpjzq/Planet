InnoDB 在更新数据的时候会采用` WAL 技术`，也就是 `Write Ahead Logging(预写日志)`

```sql
uptate emp set empname ='Java架构师养成记' where id =2;
```

- 执行器先找引擎取 ID=2 这一行。ID 是主键，引擎直接用搜索树找到这一行。如果 ID=2 这一行所在的数据页本来就在内存中，就直接返回给执行器；否则，需要先从磁盘读入内存，然后再返回；

- 执行器拿到引擎给的行数据，把这个值修改为“Java架构师养成记”，比如原来是 “测试一”，那么现在就是 "Java架构师养成记"，得到新的一行数据，再调用引擎接口写入这行新数据。

- 引擎将这行新数据更新到内存中，同时将这个更新记录到 redo  log 里面，此时 redo  log 处于 prepare 状态。然后告知执行器执行完成了，随时可以提交事务；

- 执行器生成这个操作的 binlog，并把 binlog 写入磁盘；

- 执行器调用引擎的提交事务接口，引擎把刚刚写入的 redo  log 的prepare状态改成提交 commit 状态，更新完成。

  

下面我们理一下一条　update 语句的执行过程：

```sql
update person set age = 30 where id = 1;
```

- 1.分配事务 ID ，开启事务，获取锁，没有获取到锁则等待。
- 2.执行器先通过存储引擎找到 id = 1 的数据页，如果缓冲池有则直接取出，没有则去主键索引上取出对应的数据页放入缓冲池。
- 3.在数据页内找到 id = 1 这行记录，取出，将 age 改为 30 然后写入内存
- 4.生成 redolog undolog 到内存，redolog 状态为 prepare
- 5.将 redolog undolog 写入文件并调用 fsync
- 6.server 层生成 binlog 并写入文件调用 fsync
- 7.事务提交，将 redolog 的状态改为 commited 释放锁