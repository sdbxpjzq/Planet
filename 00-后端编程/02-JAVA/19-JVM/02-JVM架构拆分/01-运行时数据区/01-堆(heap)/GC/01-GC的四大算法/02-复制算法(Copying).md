## 复制算法(Copying)

年轻代中使用的是`Minor GC`（YGC），这种GC算法采用的是复制算法(Copying)。

![](https://youpaiyun.zongqilive.cn/image/20200318162926.png)



![](https://youpaiyun.zongqilive.cn/image/20200318161543.png)



Minor GC会把Eden中的所有活的对象都移到Survivor区域中，如果Survivor区中放不下，那么剩下的活的对象就被移到Old generation中，也即一旦收集后，Eden是就变成空的了。

当对象在 Eden ( 包括一个 Survivor 区域，这里假设是 from 区域 ) 出生后，在经过一次 Minor GC 后，如果对象还存活，并且能够被另外一块 Survivor 区域所容纳( 上面已经假设为 from 区域，这里应为 to 区域，即 to 区域有足够的内存空间来存储 Eden 和 from 区域中存活的对象 )，则使用复制算法将这些仍然还存活的对象复制到另外一块 Survivor 区域 ( 即 to 区域 ) 中，然后清理所使用过的 Eden 以及 Survivor 区域 ( 即 from 区域 )，并且将这些对象的年龄设置为1，以后对象在 Survivor 区每熬过一次 Minor GC，就将对象的年龄 + 1，当对象的年龄达到某个值时 ( 默认是 15 岁，通过-XX:MaxTenuringThreshold 来设定参数)，这些对象就会成为老年代。

`-XX:MaxTenuringThreshold `— 设置对象在新生代中存活的次数

## 原理



![](https://youpaiyun.zongqilive.cn/image/20200318162852.png)

## **复制算法的优点是不会产生内存碎片，缺点是耗费空间**。

## GC之后有交换, 谁空谁是To

![](https://youpaiyun.zongqilive.cn/image/20200318163036.png)

![](https://youpaiyun.zongqilive.cn/image/20200318163103.png)

![](https://youpaiyun.zongqilive.cn/image/20200318163115.png)













