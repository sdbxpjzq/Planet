- 持久性

  一旦事务提交，则其所做的修改就会永久保存到磁盘上。是执行结果一直生效。
  
  保证事务提交后不会因为宕机等原因导致数据丢失；实现主要基于`redo log`



通过Force Log at Commit机制实现事务的持久性. 即当事务提交(commit)时, 必须先将该事务的所有日志写入到 `重做日志文件` 进行持久化, 待事务的commit操作完成才算完事 . 

`重做日志`: 在InnoDB存储引擎种, 由两部分组成 `redo log`和`undo log`.

`redo log`: 保证事务的持久性.  基本是顺序写的, 在数据库运行时不需要对redo log文件进行读取操作

`undo log`: 帮助事务回滚 以及 MVCC 的功能. 需要进行随读写

