## 影响自增主键

```sql
有表数据如下: id是自增主键
id c
1	 1
2	 2
3	 3
4	 4
```

根据以上数据, 当前的`AUTO_INCREMENT=5`

执行delete操作,

```sql
delete from t6 where id in (2,3,4);
```

然后在执行insert操作,

```sql
insert into t6 values(2, "test1"),(NULL, "test2xx"),(3, "test3");
```

此时的`AUTO_INCREMENT=8`



### 分析

mysql主键自增有个参数`innodb_autoinc_lock_mode`，他有三种可能只`0`,`1`,`2`，mysql5.1之后加入的，默认值是`1`，之前的版本可以看做都是`0`。

```sql
select @@innodb_autoinc_lock_mode;
```



## 对表大小的影响

`DELETE`只是将数据标识位删除，并没有整理数据文件，文件大小不变,

当插入新数据后，会再次使用这些被置为删除标识的记录空间.

解决办法:

该使用 `optimize table` 指令对表进行优化了.

或者`alter table A engine=Innodb`这个也可以.



