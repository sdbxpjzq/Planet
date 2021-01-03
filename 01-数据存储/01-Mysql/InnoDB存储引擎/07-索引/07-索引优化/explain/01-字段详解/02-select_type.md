## select_type

查询的类型

1. `SIMPLE` - 简单的`select`查询, 查询中不包含子查询或者`UNION`

2. `PRIMARY` — 查询中包含任何复杂的子部分, 最外层查询则被标记

3. `SUBQUERY` -- 在`select`或者`where`中包含子查询

4. `DERIVED` -- 在`FROM`列表中包含的子查询被标记为`DERIVED(衍生)`

   `mysql`会递归执行这些子查询, 把结果放在临时表里.

5. `UNION` -- 如果第二个`select`出现在`UNION`之后, 则被标记为`UNION`

   若`UNION`包含在`FROM`子句的子查询中, 外层`select`将被标记为`DERIVED`

6. `UNION RESULT` -- 从`UNION`表获取结果的`select`

