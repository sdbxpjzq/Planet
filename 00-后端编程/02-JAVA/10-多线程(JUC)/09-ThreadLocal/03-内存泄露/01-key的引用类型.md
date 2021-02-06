### 为什么要使用WeakReference（弱引用）

   如果使用强引用，ThreadLocal在用户进程不再被引用，但是只要线程不结束，在ThreadLocalMap中就还存在引用，无法被GC回收，会导致内存泄漏。如果用户线程耗时非常长，这个问题尤为明显。

   另外在使用线程池技术的时候，由于线程不会被销毁，回收之后，下一次又会被重复利用，会导致ThreadLocal无法被释放，最终也会导致内存泄露问题。

![](https://youpaiyun.zongqilive.cn/image/20210127152344.png)