## AbortPolicyWithReport

```java
public class AbortPolicyWithReport extends ThreadPoolExecutor.AbortPolicy {

  protected static final Logger logger = LoggerFactory.getLogger(AbortPolicyWithReport.class);

  private final String threadName;

  private final URL url;

  private static volatile long lastPrintTime = 0;

  private static Semaphore guard = new Semaphore(1);

  public AbortPolicyWithReport(String threadName, URL url) {
      this.threadName = threadName;
      this.url = url;
  }

  @Override
  public void rejectedExecution(Runnable r, ThreadPoolExecutor e) {
      String msg = String.format("Thread pool is EXHAUSTED!" +
                      " Thread Name: %s, Pool Size: %d (active: %d, core: %d, max: %d, largest: %d), Task: %d (completed: %d)," +
                      " Executor status:(isShutdown:%s, isTerminated:%s, isTerminating:%s), in %s://%s:%d!",
              threadName, e.getPoolSize(), e.getActiveCount(), e.getCorePoolSize(), e.getMaximumPoolSize(), e.getLargestPoolSize(),
              e.getTaskCount(), e.getCompletedTaskCount(), e.isShutdown(), e.isTerminated(), e.isTerminating(),
              url.getProtocol(), url.getIp(), url.getPort());
      logger.warn(msg);
      dumpJStack();
      throw new RejectedExecutionException(msg);
  }

  private void dumpJStack() {
      //省略实现
  }
}
```





- 输出了一条警告级别的日志，日志内容为线程池的详细设置参数，以及线程池当前的状态，还有当前拒绝任务的一些详细信息。可以说，这条日志，使用dubbo的有过生产运维经验的或多或少是见过的，这个日志简直就是日志打印的典范，其他的日志打印的典范还有spring。得益于这么详细的日志，可以很容易定位到问题所在；
- 输出当前线程堆栈详情，这个太有用了，当你通过上面的日志信息还不能定位问题时，案发现场的dump线程上下文信息就是你发现问题的救命稻草；
- 继续抛出拒绝执行异常，使本次任务失败，这个继承了JDK默认拒绝策略的特性；