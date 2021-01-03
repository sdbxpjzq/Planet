

```sql
explain extended SELECT * FROM t1 where key1 = '11';
show warnings;
```

会在 explain 的基础上额外提供一些查询优化的信息。紧随其后通 过 show warnings 命令可以得到优化后的查询语句，从而看出优化器优化了什么。

额外还有 filtered 列，是一个半分比的值，rows * filtered/100 可以估算出将要和 explain 中前一个表 进行连接的行数(前一个表指 explain 中的id值比当前表id值小的表)。





