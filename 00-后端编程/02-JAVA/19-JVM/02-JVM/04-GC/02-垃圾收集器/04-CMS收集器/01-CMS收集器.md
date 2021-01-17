## CMS收集器 - Concurrent-Mark-Sweep-并发标记清除

- `-XX:+UseConcMarkSweepGC`(老年代), 新生代只能选择`ParNew` 或者`Serial(已经不建议或废弃)`

- 关注更多的是用户线程的停顿时间(提高用户体验)
- 采用`标记-清除`算法, 对象的回收效率高
- 对于碎片问题, CMS采用基于`标记-整理`算法的`Serial Old GC`作为补偿方案, 当碎片导致内存回收不佳, 将采用`Serial Old GC`执行Full GC
- 用户线程和垃圾收集线程同时执行（不一定是并行，可能交替执行），不需要停顿用户线程，适用于对响应时间有要求的场景

![](https://youpaiyun.zongqilive.cn/image/20200425150256.png)

















































