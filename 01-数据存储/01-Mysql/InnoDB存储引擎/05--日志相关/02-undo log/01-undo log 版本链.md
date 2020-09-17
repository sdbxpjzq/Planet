为了实现 `MVVC` 和 `事务的回滚`



根据行为的不同 undo log 分为两种 `insert undo log`和`update undo log`。
 insert undo log 是在 insert 操作中产生的 undo log。因为 insert 操作的记录只对事务本身可见，对于其它事务此记录是不可见的，所以 insert undo log 可以在事务提交后直接删除而不需要进行 purge 操作。
 update undo log 是 update 或 delete 操作中产生的 undo log，因为会对已经存在的记录产生影响，为了提供 MVCC机制，因此 update undo log 不能在事务提交时就进行删除，而是将事务提交时放到入 history list 上，等待 purge 线程进行最后的删除操作。



## undo log 版本链

每行记录中, 存在 3个隐藏列:

1. row_id:  非必要存在, 表中有主键或者⾮NULL的UNIQUE键时都不会包含row_id列
2. trx_id:  必要存在,  更新本行数据的事务 id
3. roll_pointer:  必要存在,  回滚指针，它指向的是该行数据上一个版本的 undo log



![](https://youpaiyun.zongqilive.cn/image/20200914172157.png)



![](https://youpaiyun.zongqilive.cn/image/20200914172631.png)



举个例子，现在有一个事务 A，它的事务 id 为 10，向表中新插入了一条数据，数据记为 data_A，那么此时对应的 undo log 应该如下图所示

![](https://youpaiyun.zongqilive.cn/image/20200914172743.png)

接着事务 B(trx_id=20)，将这行数据的值修改为 data_B，同样也会记录一条 undo log，如下图所示，这条 undo log 的 roll_pointer 指针会指向上一个数据版本的 undo log，也就是指向事务 A 写入的那一行 undo log。

![](https://youpaiyun.zongqilive.cn/image/20200914172924.png)

只要有事务修改了这一行的数据，那么就会记录一条对应的 undo log，一条 undo log 对应这行数据的一个版本，当这行数据有多个版本时，就会有多条 undo log 日志，undo log 之间通过 roll_pointer 指针连接，这样就形成了一个 undo log 版本链

























![](https://ae01.alicdn.com/kf/H8556367662c74cf9a904fa535fde2891I.jpg)

