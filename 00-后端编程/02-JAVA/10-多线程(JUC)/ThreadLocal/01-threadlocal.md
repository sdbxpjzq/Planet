ThreadLocal是给每一个线程都创建变量的副本，保证每个线程访问都是自己的副本，相互隔离，就不会出现线程安全问题，这种方式其实用空间换时间的做法。

线程改变只会影响自己的副本，不会影响主线程原始变量



将TheadLocal对象声明成static，是为了让ThreadLocal变成强引用








   为什么要做这样的清除？

   我们知道entry对象里面包含了threadLocal和value，threadLocal是WeakReference（弱引用）的referent。每次垃圾回收期触发GC的时候，都会回收WeakReference的referent，会将referent设置为null。那么table数组中就会存在很多threadLocal = null 但是 value不为空的entry，这种entry的存在是没有任何实际价值的。这种数据通过getEntry是获取不到值，因为它里面有if (e != null && e.get() == key)这句判断。

为什么要使用WeakReference（弱引用）？

   如果使用强引用，ThreadLocal在用户进程不再被引用，但是只要线程不结束，在ThreadLocalMap中就还存在引用，无法被GC回收，会导致内存泄漏。如果用户线程耗时非常长，这个问题尤为明显。

   另外在使用线程池技术的时候，由于线程不会被销毁，回收之后，下一次又会被重复利用，会导致ThreadLocal无法被释放，最终也会导致内存泄露问题。



**ThreadLocal有哪些坑**

   内存泄露问题：

   ThreadLocal即使使用了WeakReference（弱引用）也可能会存在内存泄露问题，因为 entry对象中只把key(即threadLocal对象)设置成了弱引用，但是value值没有。还是会存在下面的强依赖：

```
Thread -> ThreaLocalMap -> Entry -> value
```



   要解决这个问题就需要调用get()、set(T value) 或 remove()方法。但是 get()和set(T value) 方法是基于垃圾回收器把key回收之后的基础之上触发的数据清理。如果出现垃圾回收器回收不及时的情况，也一样有问题。



​    所以，最保险的做法是在使用完threadLocal之后，手动调用一下remove方法，从源码可以看到，该方法会把entry中的key(即threadLocal对象)和value一起清空。



总结:

 1.每个线程都有一个threadLocalMap对象，每个threadLocalMap里面都包含了一个entry数组，而entry是由key（即threadLocal）和value（数据）组成。

  2.entry的key是弱引用，可以被垃圾回收器回收。

 3.threadLocal最常用的这四个方法：get()， initialValue()，set(T value) 和 remove()，除了initialValue方法，其他的方法都会调用expungeStaleEntry方法做key==null的数据清理工作。

  4.threadLocal可能存在内存泄露和线程安全问题，使用完之后，要手动调用remove方法。





