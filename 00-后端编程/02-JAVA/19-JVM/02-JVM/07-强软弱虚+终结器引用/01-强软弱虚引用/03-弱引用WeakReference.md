## 弱引用-发现即回收

- ==被弱引用关联的对象只能生存到下次垃圾回收发生为止==

- 在系统GC时, 只要发现弱引用, 不管系统堆空间是否充足, 都会回收掉只被弱引用关联的对象.

- 但是由于垃圾回收器的线程通常优先级很低,因此并不一定能很快的发现持有弱引用的对象, 在这种情况下, 弱引用对象可以存在较长的时间.

- 弱引用和软引用一样, 构造弱引用时,也可以指定一个引用队列, 当弱引用对象被回收时,就会加入指定的引用队列, 通过这个队列可以跟踪对象的回收情况.
- 软引用和弱引用都非常适合来保存那些可有可无的缓存数据, 
  -  当系统内存不足时, 这些缓存数据就会被回收, 不会导致内存溢出
  - 当内存资源充足时, 这些缓存数据又可以存在相当长的时间





![](https://youpaiyun.zongqilive.cn/image/20200605165910.png)





- 弱引用需要用`java.lang.ref.WeakReference`类来实现，它比软引用的生存期更短
- 对于弱引用的对象，只要垃圾回收机制一运行，**不管JVM的内存空间是否足够，都会回收该对象占用的内存。**



```java

public static void main(String[] args) {
  Object o1 = new Object();
  WeakReference weakReference = new WeakReference(o1);
  o1 = null;
  System.gc();
  System.out.println(o1); // null
  System.out.println(weakReference.get()); //null
}
```













