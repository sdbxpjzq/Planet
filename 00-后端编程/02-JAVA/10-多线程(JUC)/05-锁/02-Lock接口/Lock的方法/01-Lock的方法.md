```java
public interface Lock {

    void lock();

  // 它非常执拗，如果获取不到锁就会一直尝试获取直到获取到为止，除非当前线程在获取锁期间被中断
  // 理解为不限时的 tryLock (long time, TimeUnit unit)。
    void lockInterruptibly() throws InterruptedException;

    boolean tryLock();

    boolean tryLock(long time, TimeUnit unit) throws InterruptedException;

    void unlock();
  
  // 主要的方法 await 和 signal , 对应于 Object 的 wait 和 notify
    Condition newCondition();

}
```



ock 加锁主要有 4 个方法：

lock、

lockInterruptibly、

tryLock、

tryLock (long time, TimeUnit unit) 。

解锁只有一个 unlock 方法。



此外，还有一个线程间通信的条件（Condition）。