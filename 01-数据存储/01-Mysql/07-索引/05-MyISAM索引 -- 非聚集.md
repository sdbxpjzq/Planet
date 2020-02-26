`MyISAM`索引文件和数据文件是分离的.

MyISAM引擎使用B+Tree作为索引结构，叶节点的data域存放的是数据记录的地址

## 主键索引

主键索引,如下图:

![](https://youpaiyun.zongqilive.cn/image/006tNc79ly1fzr3ihmy9jj31020s4q6n.jpg)



## 非主键索引

如果我们在Col2上建立一个辅助索引(非主键索引), 如下图 

![](https://youpaiyun.zongqilive.cn/image/006tKfTcly1g0g46kiepej30ii0es74k.jpg)



## 查询数据

MyISAM中索引检索的算法为首先按照B+Tree搜索算法搜索索引，如果指定的Key存在，则取出其data域的值，然后以data域的值为地址，读取相应数据记录。

![](https://youpaiyun.zongqilive.cn/image/006tKfTcly1g0g4xq7do8j30810atgml.jpg)



