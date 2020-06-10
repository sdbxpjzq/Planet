字典，又称符号表、关联数组、映射，是一种保存键值对的抽象数据结构。每个键（key）和唯一的值（value）关联，**键是独一无二的**，通过对键的操作可以对值进行增删改查。

redis的`hash`数据类型也是通过字典方式实现

redis的字典，底层是使用**哈希表**实现，每个哈希表有多个哈希节点，每个哈希节点保存了一个键值对.

![](https://youpaiyun.zongqilive.cn/image/006tKfTcly1g0hlbr53euj30u00kydgs.jpg)



## 哈希表结构

```c
typedef struct dictht{
    dictEntry **table; // 哈希表数组
    unsigned long size; // 哈希表大小
    unsigned long sizemask; // 哈希表大小掩码, 用于计算索引值, 总是等于 size-1
    unsigned long used; // 该哈希表已有节点的数量
}dictht;
```

大小为4的空哈希表结构如下图

![](https://youpaiyun.zongqilive.cn/image/006tKfTcly1g0h98eu4ukj30hs097jrk.jpg)

## 哈希表节点节点

```c
typedef struct dictEntry{
    void *key; // 键值对中的 键
    // 键值对中的 值
    union{
        void *val;
        uint64_t u64;
        int64_t s64;
    }v;
    // 指向下一个哈希表节点, 形成链表
    struct dictEntry *next;
}dictEntry;
```

`key`表示节点的键

`union`表示key对应的值，可以是指针、uint64_t整数或int64_t整数

`next`是指向另一个哈希表节点的指针，该指针将多个哈希值相同的键值对连接在一起，避免因为哈希值相同导致的冲突。

哈希表节点如下图（左边第一列是哈希表结构，表节点结构从左边第二列开始）所示：

![](https://youpaiyun.zongqilive.cn/image/006tKfTcly1g0h9cpmfi8j314o0dwdgo.jpg)

## 字典

```c
typedef struct dict{
    dictType *type;
    void *privdata;
    dictht ht[2];
    int rehashidx;
}dict;
```

privdata用于存放私有数据，保存传给type内的函数的数据

rehash是一个索引，当没有在rehash进行时，值是-1；

ht是包含两个项的数组，每个项是一个哈希表，一般情况下只是用ht[0]，只有在对ht[0]进行rehash时，才会使用ht[1]。

type用于存放用于处理特定类型的处理函数

```c
typedef structdict Type{
    // 哈希值计算函数
    unsigned int (*hashFunction) (const void *key);
    // 键复制
    void *(*keyDup) (void *privdata, const void *key);
    // 值复制
    void *(*valDup) (void *privdata, const void *obj);
    //键比较
    int *(*keyCompare) (void *privdata, const void *key1, const void*key2);
    //键销毁
    void *(*keyDestructor) (void *privdata, void *key);
    //值销毁
    void *(*valDestructor) (void *privdata, void *obj);
}dictType;
```

完整的字典结构如下图所示

![](https://youpaiyun.zongqilive.cn/image/006tKfTcly1g0h9k5mkezj317u0n7q4d.jpg)

## 键冲突解决

redis采用链地址法，每个哈希表节点都有一个指向next的指针，当发生冲突时，直接将当前哈希表节点的next指针指向新的结果。后面如果还有冲突的键，则当前键的next会指向下一个哈希表节点。

![](https://youpaiyun.zongqilive.cn/image/006tKfTcly1g0h9tsh23qj312o0fk3zj.jpg)

## rehash(重新散列)

散列表内的键值对过多或过少时，需要定期进行rehash，以提升性能或节省内存.

![](https://youpaiyun.zongqilive.cn/image/006tKfTcly1g0hle6kzk9j30os0kcjs4.jpg)

1. 为字典的ht[1]散列表分配空间，这个空间的大小取决于要执行的操作以及ht[0]当前包含的键值对数量(即:ht[0].used的属性值)

![](https://youpaiyun.zongqilive.cn/image/006tKfTcly1g0hler234fj30os0ma758.jpg)

- 扩展操作：ht[1]的大小为 第一个大于等于ht[0].used*2的2的n次方幂。如:ht[0].used=3则ht[1]的大小为8，ht[0].used=4则ht[1]的大小为8。
- 收缩操作: ht[1]的大小为 第一个大于等于ht[0].used的2的n次方幂。

2. 将保存在ht[0]中的键值对重新计算键的散列值和索引值，然后放到ht[1]指定的位置上。

![](https://youpaiyun.zongqilive.cn/image/006tKfTcly1g0hlfr0z53j30p80ot75a.jpg)

3. 将ht[0]包含的所有键值对都迁移到了ht[1]之后，释放ht[0],将ht[1]设置为ht[0],并创建一个新的ht[1]哈希表为下一次rehash做准备。

![](https://youpaiyun.zongqilive.cn/image/006tKfTcly1g0hlg5r8tcj30p80ott9n.jpg)



### 渐进式 rehash

 对于rehash我们思考一个问题如果散列表当前大小为 1GB，要想扩容为原来的两倍大小，那就需要对 1GB 的数据重新计算哈希值，并且从原来的散列表搬移到新的散列表。这种情况听着就很耗时，而生产环境中甚至会更大。为了解决一次性扩容耗时过多的情况，可以将扩容操作穿插在插入操作的过程中，分批完成。当负载因子触达阈值之后，只申请新空间，但并不将老的数据搬移到新散列表中。当有新数据要插入时，将新数据插入新散列表中，并且从老的散列表中拿出一个数据放入到新散列表。每次插入一个数据到散列表，都重复上面的过程。经过多次插入操作之后，老的散列表中的数据就一点一点全部搬移到新散列表中了。这样没有了集中的一次一次性数据搬移，插入操作就都变得很快了。

​    Redis为了解决这个问题采用渐进式rehash方式。以下是Redis渐进式rehash的详细步骤:

1. 为 `ht[1]` 分配空间， 让字典同时持有 `ht[0]` 和 `ht[1]` 两个哈希表。
2. 在字典中维持一个索引计数器变量 `rehashidx` ， 并将它的值设置为 `0` ，表示 rehash 工作正式开始。
3. 在 rehash 进行期间， 每次对字典执行添加、删除、查找或者更新操作时， 程序除了执行指定的操作以外， 还会顺带将 `ht[0]` 哈希表在 `rehashidx` 索引上的所有键值对 rehash 到 `ht[1]` ， 当 rehash 工作完成之后， 程序将 `rehashidx` 属性的值增一。
4. 随着字典操作的不断执行， 最终在某个时间点上， `ht[0]` 的所有键值对都会被 rehash 至 `ht[1]` ， 这时程序将 `rehashidx` 属性的值设为 `-1` ， 表示 rehash 操作已完成。

**说明:**

**1.因为在进行渐进式 rehash 的过程中，字典会同时使用 ht[0] 和 ht[1] 两个哈希表，所以在渐进式 rehash 进行期间，字典的删除（delete）、查找（find）、更新（update）等操作会在两个哈希表上进行。**

**2. 在渐进式 rehash 执行期间，新添加到字典的键值对一律会被保存到 ht[1] 里面，而 ht[0] 则不再进行任何添加操作：这一措施保证了 ht[0] 包含的键值对数量会只减不增，并随着 rehash 操作的执行而最终变成空表。**

## 总结

每个字典有两个哈希表，一个是正常使用，一个用于rehash期间使用。当redis计算哈希时，采用的是MurmurHash2哈希算法。哈希表采用链地址法避免键的冲突，被分配到同一个地址的键会构成一个单向链表。在rehash对哈希表进行扩展或者收缩过程中，会将所有键值对进行迁移，并且这个迁移是渐进式的迁移。

































