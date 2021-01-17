## 软引用

![](https://youpaiyun.zongqilive.cn/image/20200605162707.png)



- 软引用就是一种相对强引用弱化了一些的引用。需要用`java.lang.ref.SoftReference`类来实现，可以让对象豁免一些垃圾收集。
- **系统内存充足 -> 不会回收**
- **系统内存不足 -> 会回收**
- 软引用通常用在对内存敏感的程序中，比如高速缓存就有用到软引用，**内存够用的时候就保留，不够用就回收**



![](https://youpaiyun.zongqilive.cn/image/20200425135008.png)



