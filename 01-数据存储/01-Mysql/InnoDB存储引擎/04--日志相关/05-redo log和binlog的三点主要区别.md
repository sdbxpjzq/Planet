- redo  log 是 InnoDB 引擎特有的，而 binlog 是 MySQL 的 Server 层实现的，所有引擎都可以使用；
- redo  log 是物理日志，记录的是“在某个数据写上做了什么修改”，而 binlog 是逻辑日志，记录的是这个语句的原始逻辑，比如“修改 ID = 2 这一行的 empname 为 Java架构师养成记”。
- redo  log 是循环写的，空间固定会用完，而 binlog 是可以追加写入的。“追加写”是指 binlog 文件写到一定大小后会切换到下一个新文件，并不会覆盖掉以前的日志。

