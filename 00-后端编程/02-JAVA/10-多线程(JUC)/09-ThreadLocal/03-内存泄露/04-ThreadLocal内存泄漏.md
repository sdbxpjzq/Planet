### ThreadLocal为什么会内存泄漏

==内存泄露与key是强引用还是弱引用 没有关系, 在池化环境下, 都会产生内存泄露, 只是对key为null的对象自动进行了特殊清理==

内存泄露问题：

 key 是一个弱引用, 但是value值没有。还是会存在下面的强依赖：

```
Thread -> ThreaLocalMap -> Entry(key为null) -> value
```



弱引用有利于GC的回收，当key == null时，GC就会回收这部分空间，但value不一定能被回收，

因为他和Current Thread之间还存在一个强引用的关系。由于这个强引用的关系，会导致value无法回收，如果线程对象不消除这个强引用的关系，就可能会出现OOM。

有些时候，我们调用ThreadLocalMap的remove()方法进行显式处理。

![](https://youpaiyun.zongqilive.cn/image/20201214094343.png)



**正常情况**

当Thread运行结束后，ThreadLocal中的value会被回收，因为没有任何强引用了

**非正常情况**

当Thread一直在运行始终不结束(例如线程池)，强引用就不会被回收，存在以下调用链 `Thread-->ThreadLocalMap-->Entry(key为null)-->value`因为调用链中的 value 和 Thread 存在强引用，所以value无法被回收，就有可能出现OOM。



当ThreadLocal Ref出栈后，由于ThreadLocalMap中Entry对ThreadLocal只是弱引用，所以ThreadLocal对象会被回收，Entry的key会变成null，然后在每次get/set/remove ThreadLocalMap中的值的时候，会自动清理key为null的value，这样value也能被回收了。

注意：如果ThreadLocal Ref一直没有出栈（例如上面的connectionHolder，通常我们需要保证ThreadLocal为单例且全局可访问，所以设为static），具有跟Thread相同的生命周期，那么这里的虚引用便形同虚设了，所以使用完后记得调用ThreadLocal.remove将其对应的value清除。



JDK的设计已经考虑到了这个问题，所以在set()、remove()、resize()方法中会扫描到key为null的Entry，并且把对应的value设置为null，这样value对象就可以被回收。

```java
private void resize() {
  Entry[] oldTab = table;
  int oldLen = oldTab.length;
  int newLen = oldLen * 2;
  Entry[] newTab = new Entry[newLen];
  int count = 0;

  for (int j = 0; j < oldLen; ++j) {
    Entry e = oldTab[j];
    if (e != null) {
      ThreadLocal<?> k = e.get();
      //当ThreadLocal为空时，将ThreadLocal对应的value也设置为null
      if (k == null) {
        e.value = null; // Help the GC
      } else {
        int h = k.threadLocalHashCode & (newLen - 1);
        while (newTab[h] != null)
          h = nextIndex(h, newLen);
        newTab[h] = e;
        count++;
      }
    }
  }

  setThreshold(newLen);
  size = count;
  table = newTab;
}

```



###   为什么要做这样的清除

   我们知道entry对象里面包含了threadLocal和value，threadLocal是WeakReference（弱引用）的referent。每次垃圾回收期触发GC的时候，都会回收WeakReference的referent，会将referent设置为null。那么table数组中就会存在很多threadLocal = null 但是 value不为空的entry，这种entry的存在是没有任何实际价值的。这种数据通过getEntry是获取不到值，因为它里面有if (e != null && e.get() == key)这句判断。









