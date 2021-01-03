## extra -- 重要

### using  filesort  -- 不好, 要优化掉

说明`mysql`会对数据使用一个外部的索引排序, 而不是按照表内的索引排序进行读取.

`Mysql`中无法利用索引完成的排序操作, 称为`文件排序`.



### **Using temporary**   **严重不好**

使用了临时表保存中间结果, `Mysql`在对查询结果排序时使用临时表,,  常见于排序`order by ` 和分组查询`group by`



### using index  较好的

使用了覆盖索引, 避免访问表的数据行, 效率不错

如果同时出现`using where`, 表明索引被用来执行索引键值的查找.

如果没有同时出现`using  where`, 表明索引用来读取数据而非执行查找动作.

### using where

使用 where 语句来处理结果，查询的列未被索引覆盖

### Using index condition

查询的列不完全被索引覆盖，where条件中是一个前导列的范 围;



### select tables optimized away

在没有`group by`子句的情况下, 基于索引优化`min/max` 操作或者对于`MyISAM`存储引擎优化`count(*)`操作, 不必等到执行阶段再进行计算, 查询执行计划生成的阶段即完成优化.



### impossible where

`where`字句的值总是`false`, 不能用来获取任何元组.

![](https://youpaiyun.zongqilive.cn/image/20200226122131.png)



### distinct

优化`distinct`操作, 在找到第一匹配的元素后即停止找同样值的动作.





### using join buffer



