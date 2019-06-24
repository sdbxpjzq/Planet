## count(主键ID)

会遍历整张表, 把每一行的id值取出来, 返回给server层, server层拿到id后, 判断是不可能为空的, 就按行累加.

## count(1)

遍历整张表, 但不取值, server层对于返回的每一层, 一个数字`1`进去, 判断是不可能为空的, 按行累加.

## count(字段)

如果这个字段定义为`not null`的话, 一行行的从记录里读出这个字段, 判断不能为`null`,按行累加.

如果这个字段允许为`null`, 那么执行的时候, 判断有可能为`null`, 还要把值取出来判断一下, 不是`null`才累加.

## count(*)

这是一个例外, 并不会把全部字段取出来, 而是专门做了优化, 不取值.

`count(*)`肯定不是`null`, 按行累加.

建议, 尽量使用`count(*)`

## 效率排序

count(1)要比count(主键id)快, 因为从索引返回id会涉及到解析数据行, 以及拷贝字段值的操作.

count(*) = count(1) > count(主键id) > count(字段)



## count(*) 和count(列名)区别

`count(列名)` 会过滤掉空值.

![](https://ws1.sinaimg.cn/large/006tNc79ly1fz5042107kj30f908oq33.jpg)

![](https://ws2.sinaimg.cn/large/006tNc79ly1fz503tu1czj30io0acjrj.jpg)













