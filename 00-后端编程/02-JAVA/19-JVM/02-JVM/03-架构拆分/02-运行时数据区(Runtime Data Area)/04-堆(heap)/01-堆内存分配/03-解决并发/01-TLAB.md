堆空间为每个线程分配的`TLAB(Thread Local Allocation Buffer)`

## 为什么有TLAB( Thread Local Allocation Buffer)

- 堆区是线程共享区域, 任何线程都可以访问到堆区中的共享数据
- 由于对象实例的创建在JVM中非常频繁, 因此在并发环境下从堆中划分内存空间是 线程不安全的
- 为避免多个线程操作同一地址, 需要使用加锁等机制, 进而影响分配速度



## 什么是TLAB

- JVM为每个线程分配了一个私有缓存区域, 它包含在Eden空间内
- 多线程同时分配内存时, 使用TLAB可以避免一系列的非线程安全问题, 同时还能提升内存分配的吞吐量

![](https://youpaiyun.zongqilive.cn/image/20200525095214.png)

![](https://youpaiyun.zongqilive.cn/image/20200525095304.png)

![](https://youpaiyun.zongqilive.cn/image/20200525095343.png)








