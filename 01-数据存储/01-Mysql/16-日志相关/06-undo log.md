所有的表的 undolog 都存储在同一个文件里。该文件主要用来做事务回滚和 MVCC 。undolog 是逻辑日志，也就是他不是记录的将物理的数据页恢复到之前的状态，而是记录的和原 sql 相反的 sql , 例如 insert 对应 delete , delete 对应 insert ，update 对应另外一个 update　。事务回滚很好理解，执行相反的操作回滚到之前的状态，而 MVCC 是指镜像读，当一个事务需要查询某条记录，而该记录已经被其他事务修改，但该事务还没提交，而当前事务可以通过 undolog 计算到之前的值。

![](https://ae01.alicdn.com/kf/H8556367662c74cf9a904fa535fde2891I.jpg)

