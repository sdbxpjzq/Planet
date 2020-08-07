## Executors.newFixedThreadPool()

适用: 执行长期的任务, 性能好很多

**特点：**

1. 创建一个`定长线程池`，可控制线程的最大并发数，超出的线程会在队列中等待。
2. newFixedThreadPool 创建的线程池CorePoolSize和MaximumPoolSize是相等的，它使用的是**LinkedBlockingQueue** 。





```java
private static void threadPoolInit() {
  //ExecutorService threadPool = Executors.newFixedThreadPool(5);//一池5个处理线程
  //ExecutorService threadPool = Executors.newFixedThreadPool(1);//一池1个线程
  ExecutorService threadPool = Executors.newCachedThreadPool();//一池N个线程

  //模拟10个用户来办理业务，每个用户就是一个来自外部的请求线程
  try{
    for(int i=1;i<=10;i++){
      threadPool.execute(()->{
        System.out.println(Thread.currentThread().getName()+"\t 办理业务");
      });
    }
  }catch (Exception e){
    e.printStackTrace();
  }finally {
    threadPool.shutdown();
  }
}
```

