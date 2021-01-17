## Serial收集器(-XX:+UseSerialGC / -XX:+UseSerialOldGC)

- 新生代使用`Serial GC`, 同时老年代使用`Serial Old GC`
- 新生代采用`复制算法`，老年代采用`标记-整理`算法。
- 为`单线程设计`且只是用过一个线程进行垃圾回收，会暂停所有的用户线程，不适合服务器环境
- `Serial Old GC`  在Service模式下主要有2个用途:
  - 与新生代的`Parallel Scavenge`配合使用
  - 作为老年代CMS收集器的后备方案

![](https://youpaiyun.zongqilive.cn/image/20200425145826.png)



![](https://youpaiyun.zongqilive.cn/image/20200608185229.png)

![](https://youpaiyun.zongqilive.cn/image/20200608185256.png)



















