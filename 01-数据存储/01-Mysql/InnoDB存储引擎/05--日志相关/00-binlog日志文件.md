**MySQL主从同步是基于binlog文件主从复制实现**

## binlog日志文件

binlog日志用于记录所有更新了数据或者已经潜在更新了数据（例如，没有匹配任何行的一个DELETE）的所有语句。

可以通过mysql提供的查看工具mysqlbinlog查看文件中的内容, 例如 mysqlbinlog mysql-bin.00001 | more

### **binlog日志格式**

（1） statement ： 记录每一条更改数据的sql;

- 优点：binlog文件较小，节约I/O，性能较高。
- 缺点：不是所有的数据更改都会写入binlog文件中，尤其是使用MySQL中的一些特殊函数（如LOAD_FILE()、UUID()等）和一些不确定的语句操作，从而导致主从数据无法复制的问题。

（2） row ： 不记录sql，只记录每行数据的更改细节

- 优点：详细的记录了每一行数据的更改细节，这也意味着不会由于使用一些特殊函数或其他情况导致不能复制的问题。
- 缺点：由于row格式记录了每一行数据的更改细节，会产生大量的binlog日志内容，性能不佳，并且会增大主从同步延迟出现的几率。

（3） mixed：一般的语句修改使用statment格式保存binlog，如一些函数，statement无法完成主从复制的操作，则采用row格式保存binlog，MySQL会根据执行的每一条具体的sql语句来区分对待记录的日志形式，也就是在Statement和Row之间选择一种。



