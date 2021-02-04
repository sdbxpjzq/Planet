- 尽量使用 `tryLock(long timeout,TimeUnit unit)` 的方法（`ReentrantLock 、ReenttranReadWriteLock`）设置超时时间，超时可以退出防止死锁。

```java
Lock lock = ...;
// 代码显式加锁
lock.lock();
try {
    //获取到了被本锁保护的资源，处理任务
    //捕获异常
} finally {
    //代码显式释放锁
    lock.unlock(); 
}
```

lock () 方法有个缺点就是**它不能被中断，一旦陷入死锁，lock () 就会陷入永久等待**。所以，一般来说我们会用 `tryLock` 来代替 lock

```java
Lock lock = ...;
if (lock.tryLock()) {
    try {
        //操作资源
    } finally {
        //释放锁
        lock.unlock();
    }
} else {
    //如果不能获取锁，则做其他事情
}
```



举例子

```java
public void tryLock(Lock lock1, Lock lock2) throws InterruptedException {
  while (true) {
    if (lock1.tryLock()) {
      try {
        if (lock2.tryLock()) {
          try {
            System.out.println("获取到了两把锁，完成业务逻辑");
            return;
          } finally {
            lock2.unlock();
          }
        }
      } finally {
        lock1.unlock();
      }
    } else {
      Thread.sleep(new Random().nextInt(1000));
    }
  }
}
```

