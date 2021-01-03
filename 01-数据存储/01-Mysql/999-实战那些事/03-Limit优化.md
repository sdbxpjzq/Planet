## 问题

```sql
select * from user where id=123 limit 1;
```

理解: 

如果id为主键(唯一键)的话，加不加limit 1都一样。

如果不是，就会全表扫描返回一条数据























