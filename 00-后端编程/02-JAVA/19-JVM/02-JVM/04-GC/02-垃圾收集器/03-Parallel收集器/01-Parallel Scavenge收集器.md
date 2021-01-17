## Parallel Scavenge收集器 - 并行垃圾回收器

- `-XX:+UseParallelGC`(年轻代),`-XX:+UseParallelOldGC`(老年代))
- JDK8 默认是垃圾收集器
- 新生代采用复制算法，老年代采用标记-整理算法。
- 关注点是吞吐量(高效率的利用CPU), 适用于科学计算/大数据处理等弱交互场景



`Paraller`和`ParNew`的区别:

- `Parallel`收集器的目标是达到一个可控制的吞吐量, 被称为吞吐量优先的垃圾收集器
- 只是用调节策略也是`Parallel`与`ParNew`的一个重要区别

![](https://youpaiyun.zongqilive.cn/image/20200425150022.png)



![](https://youpaiyun.zongqilive.cn/image/20200608190104.png)



![](https://youpaiyun.zongqilive.cn/image/20200425145953.png)












































