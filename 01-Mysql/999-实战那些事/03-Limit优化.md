## limit

分页查询是最常用的场景之一，但也通常也是最容易出问题的地方。

当 LIMIT 子句变成 `LIMIT 1000000,10` 时, 就会出现性能问题

### 解决方案:

前端将前一页的最大ID(或者其他条件)传给后端,作为查询条件.

```sql
where id > 1000 order by id limit 10 
```



## 问题2

```sql
select * from user where id=123 limit 1;
```

理解: 

如果id为主键(唯一键)的话，加不加limit 1都一样。如果不是，就会全表扫描返回一条数据



