![](https://youpaiyun.zongqilive.cn/image/20210314184415.png)



## type --  重要

显示了连接使用了哪种类别,有无使用索引.

### 性能排序

```
NULL > system > const > eq_ref > ref > range > index > ALL
```

一般至少保证查询达到`range`级别, 最好能达到`ref`.

### null

不用访问表或者索引就可以直接得到结果

` explain select sysdate()\G`

### system

表只有一行记录, 这是`const`类型的特例, 平时不会出现,  可以忽略不计

### const

表示通过索引一次就找到了, `const`用于比较`primary key` 或者`unique`索引,

因为是只匹配一行数据, 所以很快

若将主键置于`where`列表中, `mysql`就能将该查询转换为一个常量

### eq_ref

唯一索引扫描, 对于每个索引键, 表中只有一条记录与之匹配, 常见于 主键 或 唯一索引扫描

### ref

非唯一性索引扫描, 返回匹配的所有行.



### REF_OR_NULL

类似REF，只是搜索条件包括：连接字段的值可以为NULL的情况，比如 where col = 2 or col is null



### range

范围扫描, 一般是在`where`子句中出现了`between`, `< , > , in`等查询

### index

只遍历索引树(也是全局扫描), 通常比`all`快,  

`index`是从索引中读取, `all`是从磁盘中读取

当我们可以使⽤索引覆盖，但需要扫描全部的索引记录时

### all

遍历全表,查询是性能最差的查询

