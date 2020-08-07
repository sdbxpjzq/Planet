## 实现ThreadFactory接口

```java
static class NameThreadFactory implements ThreadFactory {
  private static final AtomicInteger poolNumber = new AtomicInteger(1);
  private final ThreadGroup group;
  private final AtomicInteger threadNumber = new AtomicInteger(1);
  private final String namePrefix;

  // 传入name
  NameThreadFactory(String name) {
    SecurityManager s = System.getSecurityManager();
    group = (s != null) ? s.getThreadGroup() :
    Thread.currentThread().getThreadGroup();
    // 重写 namePrefix
    namePrefix = name +
      poolNumber.getAndIncrement() +
      "-thread-";
  }

  @Override
  public Thread newThread(Runnable r) {
    Thread t = new Thread(group, r,
                          namePrefix + threadNumber.getAndIncrement(),
                          0);
    if (t.isDaemon())
      t.setDaemon(false);
    if (t.getPriority() != Thread.NORM_PRIORITY)
      t.setPriority(Thread.NORM_PRIORITY);
    return t;
  }
}
```





```java
private ExecutorService executorService = new ThreadPoolExecutor(100, 100, 5, TimeUnit.SECONDS, new ArrayBlockingQueue(9000),
                                                                new NamedThreadFactory("diy-goods-task"));
```

