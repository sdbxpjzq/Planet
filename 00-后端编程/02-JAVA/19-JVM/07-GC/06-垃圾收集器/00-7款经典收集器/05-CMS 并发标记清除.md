## 并发垃圾回收器（CMS）-Concurrent-Mark-Sweep-低延迟

`-XX:+UseConcMarkSweepGC`

**CMS是针对`老年代`的垃圾回收器**

采用`标记-清除`算法, 并且也会`STW`.

用户线程和垃圾收集线程同时执行（不一定是并行，可能交替执行），不需要停顿用户线程，适用于对响应时间有要求的场景



![](https://youpaiyun.zongqilive.cn/image/20200604191717.png)

