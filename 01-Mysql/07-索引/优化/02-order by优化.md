Mysql两种排序方式:

1. 文件排序
2. 扫描有序索引排序

## 排序用到索引

### 案例1

组合索引 Index(A,B)。

- 下面条件可以用上组合索引排序：

- - ORDER BY A——首列排序
  - A=5 ORDER BY B——第一列过滤后第二列排序
  - ORDER BY A DESC, B DESC——注意，此时两列以相同顺序排序
  - A>5 ORDER BY A——数据检索和排序都在第一列

- 下面条件不能用上组合索引排序：

- - ORDER BY B ——排序在索引的第二列
  - A>5 ORDER BY B ——范围查询在第一列，排序在第二列
  - A IN(1,2) ORDER BY B ——理由同上
  - ORDER BY A ASC, B DESC ——注意，此时两列以不同顺序排序

### 案例2

KEY  a_b_c(a, b, c),  会创建如下索引

```
a,b,c
a,b
a
```

1. `order by`能够使用索引最左前缀

```sql
order by a

order by a, b

order by a, b, c

order by a desc, b desc, c desc  [排序方式也要保持一致]

```

2. 不满足最左前缀时,第一列被指定为常量

```sql
where a = const order by b, c
where a = const and b = const order by c
where a = const order by b, c
```

注意下边的情况, 遵循

```sql
where a = const and b > const order by b, c
where a = const and b > const order by a,
where a = const and b > const order by b,
```



## 排序不能使用索引

```sql
where a = const and b > const order by c,
```



```sql
order by a asc , b desc , c desc;  # 排序不一致
where g = const order by b,c; # 丢失a索引
where a = const order by c; # 丢失b索引
where a = const order by a, d; # d 不是索引的一部分
where a in(...) order by b, c; # 大哥使用范围查询, 导致群龙无首

```

## `filesort`说明

`order by`子句, 尽量使用`Index`方式排序, 避免使用`FileSort`方式排序

尽可能在索引列上完成排序操作, 遵照索引建的最佳左前缀

如果不在索引列上, `filesort`有两种算法: 

### 双路排序

字面意思就是两次扫描磁盘, 最终得到数据

读取指针和`order by` 列, 对他们进行排序, 然后扫描已经排序好的列表, 按照列表中的值重新从列表中读取对应的数据出来.

从磁盘取排序字段, 在`buffer`进行排序, 再从磁盘取其他字段

### 单路排序

从磁盘读取查询需要的所有列, 按照`order by`列, 在`buffer`对它们进行排序, 然后扫描排序后的列表输出.

它的效率更快一些, 避免了第二次读取数据, 并且把随机IO变成了顺序IO,但是它会使用更多的空间, 因为它把每一行都保存在内存中了.

#### 单路问题

在`sort_buffer`中, 单路排序要占用很多空间, 因为单路排序要把所有的字段全部取出, 所以有可能取出的数据的总大小超出了`sort_buffer`容量大小,导致每次只能取`sort_buffer`容量带大小的数据, 进行排序(创建tmp文件, 多路合并), 排完再取,

本来想省一次IO操作, 反而导致了大量的IO操作, 得不偿失.

#### 优化策略

1. 增大`sort_buffer_size`参数的设置
2. 增大`max_length_for_sort_data`参数的设置

## 提高order by速度

1. `order by` 时`select * `是一个大忌, 只需查询出需要的字段, 这点非常重要

   1. 当查询的字段大小总和 < `max_length_for_sort_data`, 而且排序字段不是`TEXT|BLOB`类型时, 会用改进后的算法— 单路排序, 否则用—多路排序
   2. 两种算法的数据都有可能超出`sort_buffer`的容量, 超出之后, 会创建`tmp`文件进行合并排序, 导致多次IO,但是用单路排序算法的风险会更大一些, 所以要提高`sort_buffer_size`

2. 尝试提高`sort_buffer_size`

   不管用哪种算法, 提高这个蚕食都会提高效率, 当然, 要根据系统的能力去提高,因为这个参数是针对每个进程的

3. 尝试提高`max_length_for_sort_data`

   提高这个参数, 会增加使用单路排序算法的概率. 如果设置的太高, 数据总容量超出`sort_buffer_size`的概率就增大,明显症状是 **高的磁盘IO和低的处理器使用率**

## 案例图示

![image-20190130142634096](https://ws2.sinaimg.cn/large/006tNc79ly1fzoles9pvtj313d0fqh0b.jpg)



































