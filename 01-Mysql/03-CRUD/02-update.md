```sql
UPDATE table_name SET field1=new-value1, field2=new-value2
[WHERE Clause]
```

```sql
有表数据如下:
id c
1	 1
2	 2
3	 3
4	 4
```

执行下面的sql

```sql
UPDATE t SET c=1 WHERE id=1;
Rows matched: 1  Changed: 0  Warnings: 0
```

matched: 匹配到一行

Changed: 影响行数

**msyql在update相同数据的时候是不会做change操作的**





