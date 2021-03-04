ConcurrentHashMap 的get没有加锁的话，ConcurrentHashMap是如何保证读到的数据不是脏数据的呢?

> get操作可以无锁是由于Node的元素val和指针next是用volatile修饰的

```java
static class Node<K,V> implements Map.Entry<K,V> {
    final int hash;
    final K key;
    //可以看到这些都用了volatile修饰
    volatile V val;
    volatile Node<K,V> next;
}
```



既然volatile修饰数组对get操作没有效果那加在数组上的volatile的目的是什么呢？

```java
transient volatile Node<K,V>[] table;
```

> 其实就是为了使得Node数组在扩容的时候对其他线程具有可见性而加的volatile
>
> - 数组用volatile修饰主要是保证在数组扩容的时候保证可见性。