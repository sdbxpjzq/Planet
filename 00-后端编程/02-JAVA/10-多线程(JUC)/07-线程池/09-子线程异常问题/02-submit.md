 submit在控制台没有直接输出，必须调用Future.get()方法时，可以捕获到异常。

```java
@Slf4j
class MyThreadPoolExecutorCallable extends ThreadPoolExecutor {

  public MyThreadPoolExecutorCallable(int corePoolSize, int maximumPoolSize, long keepAliveTime, TimeUnit unit, BlockingQueue<Runnable> workQueue) {
    super(corePoolSize, maximumPoolSize, keepAliveTime, unit, workQueue);
  }

  public MyThreadPoolExecutorCallable(int corePoolSize, int maximumPoolSize, long keepAliveTime, TimeUnit unit, BlockingQueue<Runnable> workQueue, ThreadFactory threadFactory) {
    super(corePoolSize, maximumPoolSize, keepAliveTime, unit, workQueue, threadFactory);
  }

  public MyThreadPoolExecutorCallable(int corePoolSize, int maximumPoolSize, long keepAliveTime, TimeUnit unit, BlockingQueue<Runnable> workQueue, RejectedExecutionHandler handler) {
    super(corePoolSize, maximumPoolSize, keepAliveTime, unit, workQueue, handler);
  }

  public MyThreadPoolExecutorCallable(int corePoolSize, int maximumPoolSize, long keepAliveTime, TimeUnit unit, BlockingQueue<Runnable> workQueue, ThreadFactory threadFactory, RejectedExecutionHandler handler) {
    super(corePoolSize, maximumPoolSize, keepAliveTime, unit, workQueue, threadFactory, handler);
  }

  @Override
  protected void beforeExecute(Thread t, Runnable r) {
    System.out.println("beforeExecute " + t.getId() + t.getName());
  }

  @Override
  protected void afterExecute(Runnable r, Throwable t) {
    // todo submit 在这里捕获不到的
  }
}

class MyCallable implements Callable<String> {
  private int planId;

  public MyCallable(int planId) {
    this.planId = planId;
  }

  public int getPlanId() {
    return planId;
  }

  public void setPlanId(int planId) {
    this.planId = planId;
  }

  @Override
  public String call() throws Exception {
    // todo 可以在这里 try...catch
    if (Math.random() * 10 < 5) {
      System.out.println("threadId: " + Thread.currentThread().getId() + ",ThreadName: " + Thread.currentThread().getName() + "-产生异常");
      System.out.println(10 / 0);
    }
    return planId + "ok";
  }
}

@Slf4j
class ThreadPoolExceptionTestSubmit {
  @SneakyThrows
  public static void main(String[] args) {
    MyHandler myHandler = new MyHandler();
    ThreadFactory threadFactory = new ThreadFactoryBuilder().setNameFormat("自定义线程名-%d").build();
    ExecutorService pool = new MyThreadPoolExecutorCallable(10, 20, 1, TimeUnit.SECONDS,
                                                            new LinkedBlockingQueue<>(100), threadFactory);

    ArrayList<Future<String>> futureList = new ArrayList<>();
    for (int i = 1; i <= 5; i++) {
      // submit 提交任务
      futureList.add(pool.submit(new MyCallable(i)));
    }

    for (Future<String> future : futureList) {
      try {
        // todo 异常是绑定到 Future 上了， 调用 future.get() 的时候，触发异常
        future.get();
      } catch (Throwable t) {
        log.error("ex = {}", t.getMessage());
      }
    }
  }
}
```

