

针对 tryLock () 方法，它不遵守设定的公平原则。

> 例如，当有线程执行 tryLock () 方法的时候，一旦有线程释放了锁，那么这个正在 tryLock 的线程就能获取到锁，即使设置的是公平锁模式，即使在它之前已经有其他正在等待队列中等待的线程，简单地说就是 tryLock 可以插队。



```java
public boolean tryLock() {
  // 这里调用的就是 nonfairTryAcquire ()，表明了是不公平的，和锁本身是否是公平锁无关。
    return sync.nonfairTryAcquire(1);
}
```

