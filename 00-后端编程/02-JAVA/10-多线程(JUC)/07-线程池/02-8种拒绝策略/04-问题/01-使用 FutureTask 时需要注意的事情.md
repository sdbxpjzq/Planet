不建议把拒绝策略设置为 DiscardPolicy 和 DiscardOldestPolicy

```java
class FutureTest {
    // (1) 线程池单个线程, 线程池队列元素个数为1
    private final static ThreadPoolExecutor executorService = new ThreadPoolExecutor(1,1,1L,
            TimeUnit.MINUTES, new ArrayBlockingQueue<Runnable>(1), new ThreadPoolExecutor.DiscardPolicy());

    public static void main(String[] args) throws ExecutionException, InterruptedException {
        // (2) 添加任务 one
        Future futureOne = executorService.submit(new Runnable() {
            @Override
            @SneakyThrows
            public void run() {
                System.out.println("start one");
                Thread.sleep(5000);
                return;
            }
        });

        // (2) 添加任务 two
        Future futureTwo = executorService.submit(new Runnable() {
            @Override
            @SneakyThrows
            public void run() {
                System.out.println("start two");
                Thread.sleep(5000);
            }
        });

        // (2) 添加任务 three
      // submit 返回 状态 为NEW的 FutureTask
        Future futureThree = executorService.submit(new Runnable() {
            @Override
            @SneakyThrows
            public void run() {
                System.out.println("start three");
                Thread.sleep(5000);
            }
        });

        System.out.println("task one:"+ futureOne.get());
        System.out.println("task one:"+ futureTwo.get());
      // 程序阻塞
        System.out.println("task one:"+ futureThree.get());
        executorService.shutdown();
    }
```

再看一下get()源码:

```java
public V get() throws InterruptedException, ExecutionException {
  int s = state;
  // 当状态位＜＝COMPLETING时需要等待 ，否则调用 report返回
  if (s <= COMPLETING)
    s = awaitDone(false, 0L);
  return report(s);
}

private V report(int s) throws ExecutionException {
  Object x = outcome;
  // 状态位为 NORMAL正常返回
  if (s == NORMAL)
    return (V)x;
  // 状态值大于等于CANCELLED则抛出异常
  if (s >= CANCELLED)
    throw new CancellationException();
  throw new ExecutionException((Throwable)x);
}
```

当 Future 的状态＞COMPLETING 时 调用 get 方法才会返回， 而明显 DiscardPolicy 策略在拒绝元素时并没有设置该 Future 的状 态 ， 后面 也 没有其他机会可以设置该 Future 的状 态，所以 Future 的状态 一直是 NEW ，所以 一直不会返回 。 

同理， DiscardOldestPolicy 策略也存在这样的 问题， 最老 的任务被淘汰时没有设置被淘汰任务对 应 Future 的状态 。

那么默认的 AbortPolicy 策略为啥没 问题呢？ 其实在执行 AbortPolicy 策略时， 会直接抛出 RjectedExecutionExc巳ption 异常 ，也 就是 submit 方法并没有返回 Future 对象， 这时候 futureThree 是 null 。



## 解决办法

1. 使用带超时时间的get方法

2. 重写 DiscardPolicy 的拒绝策略

   ```java
   class FutureTest {
     static class MyRejectedExecutionHandler implements RejectedExecutionHandler {
       @Override
       public void rejectedExecution(Runnable r, ThreadPoolExecutor executor) {
         if (!executor.isShutdown()) {
           if (r != null && r instanceof FutureTask) {
             ((FutureTask)r).cancel(true);
           }
         }
       }
     }
     // (1) 线程池单个线程, 线程池队列元素个数为1
     private final static ThreadPoolExecutor executorService = new ThreadPoolExecutor(1,1,1L,
                                                                                      TimeUnit.MINUTES, new ArrayBlockingQueue<Runnable>(1), new MyRejectedExecutionHandler());
   
     public static void main(String[] args) throws ExecutionException, InterruptedException {
       Future futureOne = null;
       Future futureTwo = null;
       Future futureThree = null;
       try {
         // (2) 添加任务 one
         futureOne = executorService.submit(new Runnable() {
           @Override
           @SneakyThrows
           public void run() {
             System.out.println("start one");
             Thread.sleep(5000);
             return;
           }
         });
   
         // (2) 添加任务 two
         futureTwo = executorService.submit(new Runnable() {
           @Override
           @SneakyThrows
           public void run() {
             System.out.println("start two");
             Thread.sleep(5000);
           }
         });
   
         // (2) 添加任务 three
         futureThree = executorService.submit(new Runnable() {
           @Override
           @SneakyThrows
           public void run() {
             System.out.println("start three");
             Thread.sleep(5000);
           }
         });
       } catch (Exception e) {
         executorService.shutdown();
         return;
       }
   
       System.out.println("task one:"+ futureOne.get(100));
       System.out.println("task one:"+ futureTwo.get());
       try {
         System.out.println("task one:"+ ( futureThree == null? "diy null" : futureThree.get()));
       } catch (Exception e) {
         System.out.println(e.getLocalizedMessage());
       }
       executorService.shutdown();
     }
   
   }
   
   /*
   start one
   start two
   task one:null
   task one:null
   null
   */
   ```

   

