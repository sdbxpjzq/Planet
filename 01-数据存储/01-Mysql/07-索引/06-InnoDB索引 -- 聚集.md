InnoDB要求表必须有主键（MyISAM可以没有），如果没有显式指定，则MySQL系统会自动选择一个可以唯一标识数据记录的列作为主键，如果不存在这种列，则MySQL自动为InnoDB表生成一个隐含字段作为主键，这个字段长度为6个字节，类型为长整形。





数据文件本身就是索引文件

表数据文件本身就是按`B+Tree`组织的一个索引结构文件

聚集索引- 叶子节点包含了完整的数据记录

`InnoDB`表必须有主键, 并且推荐使用整型自增的主键

## 主键索引

![](https://ws4.sinaimg.cn/large/006tNc79ly1fzql2kde0fj31cm0iq770.jpg)

## 非主键索引

![image-20190131182401127](https://ws4.sinaimg.cn/large/006tNc79ly1fzpxw2qw50j312u0g645a.jpg)

> 非主键索引叶子节点存储主键值

![image-20190131185518069](https://ws1.sinaimg.cn/large/006tKfTcly1g0g4yv0l6aj31v80qux0t.jpg)

## 检索

非主键索引需要检索两遍索引：首先检索辅助索引获得主键，然后用主键到主索引中检索获得记录。

![](https://ws4.sinaimg.cn/large/006tKfTcly1g0g4yeeljzj30780a6mxy.jpg)



## 为什么推荐使用整型的自增主键?

若是自增的, 会直接往`B+Tree`后边追加, 

无序的话, 就有可能造成原有已经存好的出现分裂现象, 造成数据迁移,造成磁盘碎片



## 最左前缀(组合索引)

B+ 树这种索引结构，可以利用索引的“最左前缀”，来定位记录

BTree的一个node可以存储多个关键字

用`（name，age）`这个联合索引来分析

![](https://ws2.sinaimg.cn/large/006tKfTcly1g0fhkv0lcuj30vq0mqaar.jpg)



`create index index_name on table(name);`

此时,会根据你的索引字段生成一颗新的B+树,因此， 我们每加一个索引，就会增加表的体积， 占用磁盘存储空间.然而，**注意看叶子节点**，非聚簇索引的叶子节点并不是真实数据，它的叶子节点依然是索引节点，存放的是该索引字段的值以及对应的主键索引(聚簇索引)。

![](https://ws3.sinaimg.cn/large/006tKfTcly1g0gajyhrynj30ji0gfwex.jpg)

执行`select * from table where name='lisi'`

![](https://ws3.sinaimg.cn/large/006tKfTcly1g0gako1vk4j30ji0hmgm6.jpg)

通过上图红线可以看出，先从非聚簇索引树开始查找，然后找到聚簇索引后。根据聚簇索引，在聚簇索引的B+树上，找到完整的数据

### 什么情况下不去主键聚簇索引上查询呢?

`select name from table where name='lisi'`

![](https://ws3.sinaimg.cn/large/006tKfTcly1g0gamr5eg3j30ji0gfq3e.jpg)

**当执行`select col from table where col = ?`，col上有索引的时候，效率比执行`select * from table where col = ? `速度快好几倍！**



那么这个时候，我们执行了下述语句，又会发生什么呢？

`create index index_birthday on table(birthday);`

![](https://ws1.sinaimg.cn/large/006tKfTcly1g0gaqlo5guj30ji0k03z8.jpg)

 





`key(last_name,first_name,dob)`

![](https://ws4.sinaimg.cn/large/006tKfTcly1g0g5pf6gmpj30rs05it8y.jpg)

![](https://ws4.sinaimg.cn/large/006tKfTcly1g0g5wnfx12j30mh09wq38.jpg)





## 聚簇索引的优势

1. 由于行数据和叶子节点存储在一起，这样主键和行数据是一起被载入内存的，找到叶子节点就可以立刻将行数据返回了，如果按照主键Id来组织数据，获得数据更快。
2. 辅助索引使用主键作为"指针" 而不是使用行地址值作为指针的好处是，减少了当出现行移动或者数据页分裂时辅助索引的维护工作，使用主键值当作指针会让辅助索引占用更多的空间，换来的好处是InnoDB在移动行时无须更新辅助索引中的这个"指针"，使用聚簇索引可以保证不管这个主键B+树的节点如何变化，辅助索引树都不受影响。