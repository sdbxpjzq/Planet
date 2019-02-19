## 跳跃表

有点`空间换时间` 的意思, 

提取多级索引, 这样的多层级链表结构, 就是所谓的跳跃表.

栗子如下:

### 案例

![](https://ws1.sinaimg.cn/large/006tKfTcly1g0bx2xos1mj316c0fujtp.jpg)

新的节点可以先和2级索引比较, 确定大体范围:  然后再和1级索引比较,最后再回到原链表, 找到并插入对应位置.

至于提取的极限, 则是同一层只有2个节点的时候, 因为一个节点没有比较的意义.

## 如何选择索引

跳跃表的设计者采用了一种有趣的办法---抛硬币, 也就是随机决定新节点是否提拔, 每向上提拔一层的几率是 50%.

假如值为9新节点插入原链表.

![](https://ws3.sinaimg.cn/large/006tKfTcly1g0bxfuywpcj316i0fu76a.jpg)

![](https://ws3.sinaimg.cn/large/006tKfTcly1g0bxhxzx0cj31700ggdj1.jpg)



![](https://ws2.sinaimg.cn/large/006tKfTcly1g0bxipl534j316u0gewhi.jpg)



## 插入节点流程

新节点和各层索引节点逐一比较，确定原链表的插入位置。`O（logN）`

把索引插入到原链表。`O（1）`

利用抛硬币的随机方式，决定新节点是否提升为上一级索引。结果为“正”则提升并继续抛硬币，结果为“负”则停止。`O（logN）`

总体上，跳跃表插入操作的时间复杂度是`O（logN）`，而这种数据结构所占空间是2N，既空间复杂度是 `O（N）`。



## 删除节点

删除节点5.

如果某一层索引再删除后只剩下一个节点, 那么整个一层就可以干掉了.

![](https://ws4.sinaimg.cn/large/006tKfTcly1g0bxkuft1oj316g0eojtm.jpg)

![](https://ws4.sinaimg.cn/large/006tKfTcly1g0bxls4ffjj316g0ai408.jpg)

自上而下，查找第一次出现节点的索引，并逐层找到每一层对应的节点。`O（logN）`

删除每一层查找到的节点，如果该层只剩下1个节点，删除整个一层（原链表除外）。`O（logN）`

总体上，跳跃表删除操作的时间复杂度是`O（logN）`。























































g