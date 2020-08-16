execute方法,可以看异常输出在控制台 



```java
@Slf4j
public class MyHandler implements Thread.UncaughtExceptionHandler {
    @Override
    public void uncaughtException(Thread t, Throwable e) {
        // TODO 只有线程 和异常的相关信息
        // log.error(" uncaughtException threadId = {}, threadName = {}, ex = {}", t.getId(), t.getName(), e.getMessage());
    }
}
```





```java

@Slf4j
class MyThreadPoolExecutorRunnable extends ThreadPoolExecutor {

    public MyThreadPoolExecutorRunnable(int corePoolSize, int maximumPoolSize, long keepAliveTime, TimeUnit unit, BlockingQueue<Runnable> workQueue) {
        super(corePoolSize, maximumPoolSize, keepAliveTime, unit, workQueue);
    }

    public MyThreadPoolExecutorRunnable(int corePoolSize, int maximumPoolSize, long keepAliveTime, TimeUnit unit, BlockingQueue<Runnable> workQueue, ThreadFactory threadFactory) {
        super(corePoolSize, maximumPoolSize, keepAliveTime, unit, workQueue, threadFactory);
    }

    public MyThreadPoolExecutorRunnable(int corePoolSize, int maximumPoolSize, long keepAliveTime, TimeUnit unit, BlockingQueue<Runnable> workQueue, RejectedExecutionHandler handler) {
        super(corePoolSize, maximumPoolSize, keepAliveTime, unit, workQueue, handler);
    }

    public MyThreadPoolExecutorRunnable(int corePoolSize, int maximumPoolSize, long keepAliveTime, TimeUnit unit, BlockingQueue<Runnable> workQueue, ThreadFactory threadFactory, RejectedExecutionHandler handler) {
        super(corePoolSize, maximumPoolSize, keepAliveTime, unit, workQueue, threadFactory, handler);
    }

    private Thread t;

    @Override
    protected void beforeExecute(Thread t, Runnable r) {
        // todo beforeExecute
        System.out.println("beforeExecute " + t.getId() + t.getName());
        this.t = t;
    }

    @Override
    protected void afterExecute(Runnable r, Throwable t) {
        // todo afterExecute (处理异常, 监控线程池)
      	// todo 异常处理方式2
        MyRunnable newR = (MyRunnable) r;
        System.out.println("异常的计划ID: " + newR.getPlanId());
        log.error("threadId = {}, threadName = {}, ex = {}", this.t.getId(), this.t.getName(), t.getMessage());
        // System.out.println("afterExecute 核心线程数"+this.getCorePoolSize()+"最大线程数"+this.getMaximumPoolSize());
    }
}


class MyRunnable implements Runnable {
    private int planId;

    public MyRunnable(int planId) {
        this.planId = planId;
    }

    public int getPlanId() {
        return planId;
    }

    public void setPlanId(int planId) {
        this.planId = planId;
    }

    @Override
    @SneakyThrows
    public void run() {
      // todo  可以在这里 try...catch
        if (Math.random() * 10 < 5) {
            System.out.println("ThreadName: " + Thread.currentThread().getName() + "-进来了");
            Thread.sleep(2000);
            System.out.println("ThreadName: " + Thread.currentThread().getName() + "-出去了");
        } else {
            System.out.println("ThreadName: " + Thread.currentThread().getName() + "-产生异常");
            System.out.println(10 / 0);
        }
    }
}

public class ThreadPoolExceptionTestExecute {
    @SneakyThrows
    public static void main(String[] args) {
        MyHandler myHandler = new MyHandler();
      ThreadFactory threadFactory = new ThreadFactoryBuilder().setNameFormat("自定义线程名-%d")
                // todo 异常处理方式2
                .setUncaughtExceptionHandler(myHandler).build();
        ExecutorService pool = new MyThreadPoolExecutorRunnable(8, 16, 1, TimeUnit.SECONDS,
                new  LinkedBlockingQueue<>(100), threadFactory);

        for (int i = 1; i <= 5; i++) {
            try {
                // execute 提交任务
                pool.execute(new MyRunnable(i));
            } catch (Exception e) {

            }
        }
    }
}
```

