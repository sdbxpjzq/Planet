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







-- 增
​    INSERT [INTO] 表名 [(字段列表)] VALUES (值列表)[, (值列表), ...]
​        -- 如果要插入的值列表包含所有字段并且顺序一致，则可以省略字段列表。
​        -- 可同时插入多条数据记录！
​        REPLACE 与 INSERT 完全一样，可互换。
​    INSERT [INTO] 表名 SET 字段名=值[, 字段名=值, ...]
-- 查
​    SELECT 字段列表 FROM 表名[ 其他子句]
​        -- 可来自多个表的多个字段
​        -- 其他子句可以不使用
​        -- 字段列表可以用*代替，表示所有字段
-- 删
​    DELETE FROM 表名[ 删除条件子句]
​        没有条件子句，则会删除全部
-- 改
​    UPDATE 表名 SET 字段名=新值[, 字段名=新值][更新条件]