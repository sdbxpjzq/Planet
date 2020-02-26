压缩列表（ziplist）是列表键（list）和哈希键（hash）底层的实现之一。当列表项较少，且每项要么是小的整数值，要么是长度比较短的字符串，则使用ziplist。当哈希的键值对较少，且每个键值对都是小整数或短字符串，也是使用ziplist。

## 压缩列表构成

压缩列表是redis为了节约内存开发的，由一系列特殊编码的**连续内存块组成**的顺序型数据结构。每个压缩列表有多个节点（entry），节点可以保存一个字节数组或者整数值。

![](https://youpaiyun.zongqilive.cn/image/006tKfTcly1g0han4rxufj30hs014mx0.jpg)

![](https://youpaiyun.zongqilive.cn/image/006tKfTcly1g0hapd6sjjj31aq0h4aec.jpg)	

![](https://youpaiyun.zongqilive.cn/image/006tKfTcly1g0haupr8swj31b60jgtbx.jpg)

## 压缩节点构成

![](https://youpaiyun.zongqilive.cn/image/006tKfTcly1g0hlkuji7uj30hs01ywed.jpg)

每个节点都是由`previous_entry_length`、`encoding`、`content`三部分组成。

### previous_entry_length

字节的previous_entry_length属性，以字节为单位，记录ziplist中前一个节点的长度。该属性的长度是1字节或5字节。

当前一个节点长度小于254字节，则该属性是1字节；如果前一个节点大于254，则该属性是5字节，第一字节是0xFE（十进制254），后面四个字节用于表示前一节点长度。

如前一节点长度是5字节，则previous_entry_length=0x05；前一节点的长度是10086字节，则previous_entry_length=0xFE00002766（后面8位才是表示真实的长度）。

previous_entry_length属性用于计算出该节点前一个节点的内存位置，以便于从表尾向表头进行遍历。

### encoding

encoding记录了节点content的属性所保存的类型和长度。下表中的下划线_表示留空，a、b、x表示实际的二进制（0或1都可以）。

1）1字节长，以11开头的值，是整数编码。除掉开头的11，剩下的6位表示的10进制的值，用于表示整数的类型和长度。

![](https://youpaiyun.zongqilive.cn/image/006tKfTcly1g0hlmcyx1jj30hs056wer.jpg)

2）1、2、5字节长，以00、01、10开头的值，表示字节数组编码。除掉开头的两个数字，剩余的数字表示的值，用于表示字节数组的类型和长度。

![](https://youpaiyun.zongqilive.cn/image/006tKfTcly1g0hlmq0wnyj30hs038jrh.jpg)

### content

content保存节点具体的值，可以是一个字节数组或者一个整数，值的类型和长度由上面的encoding决定。

如encoding=00001011（表示长度是11的字节数组），则content可以是“helloworld”；encoding=11000000（表示int16_t类型整数），则content可以是10086。

## 连锁更新

考虑到一种特殊情况，ziplist中有多个连续的、长度在250~253字节的节点e1~eN，则所有节点的previous_entry_length属性都是1字节。

此时，将一个大于254字节的节点插入到e1之前，则e1的previous_entry_length需要扩充到5字节。

而这样会造成一个麻烦，此时由于e1增加了4个字节，导致其从250~253字节变成了254~257字节，则e2的previous_entry_length也需要扩充到5字节。这样的更新会一直连锁到eN为止。

上述情况称为连锁更新（cascadeupdate）。除了新增，删除节点也有可能导致连锁更新。

连锁更新的最坏情况下对ziplist进行N次空间重分配，每次重分配最坏的复杂度是O(N)，所以连锁更新的时间复杂度是O(N2)。

虽然如此，但是由于多个连续节点长度都在250~253字节出现的情况很少，而部分连续节点的更新也不会耗很多时间，因而ziplist的效率仍然很高。















https://mp.weixin.qq.com/s/H4MSW5S8nvmvDFJYfzVHkQ











