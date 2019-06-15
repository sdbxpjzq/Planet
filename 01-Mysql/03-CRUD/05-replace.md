## 主键ID已经存在

```sql
replace into t6(id,name) values(9, "tes3xxx");
```

更新值不一样, 返回`2`

更新值一样, 返回`1`

不影响主键递增ID

## 

## UNIQUE 已经存在

```sql
replace into t6(uniq_id, name) VALUES(100, '11');
```

每次插入的时候如果唯一索引对应的数据已经存在，会删除原数据，然后重新插入新的数据，这也就导致id会增大，但实际预期可能是更新那条数据。

