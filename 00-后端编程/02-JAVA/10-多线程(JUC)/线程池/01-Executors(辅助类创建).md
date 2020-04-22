![](https://youpaiyun.zongqilive.cn/image/20200422184023.png)



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

## Executors.newFixedThreadPool()

适用: 执行长期的任务, 性能好很多

**特点：**

1. 创建一个定长线程池，可控制线程的最大并发数，超出的线程会在队列中等待。
2. newFixedThreadPool 创建的线程池CorePoolSize和MaximumPoolSize是相等的，它使用的是**LinkedBlockingQueue** 。

## Executors.newSingleThreadExecutor()

适用: 一个任务一个任务执行的场景

**特点：**

1. 创建一个单线程化的线程池，它只会用唯一的工作线程来执行任务，保证所有任务都按照指定的顺序执行。
2. newSingleThreadExecutor将corePoolSize和MaximumPoolSize都设置为1，它使用的是**LinedBlockingQueue** 。

## Executors.newCachedThreadPool()

适用:  执行很多短期异步的小程序, 

**特点：**

1. 创建一个可缓存线程池，如果线程池长度超过处理需要，可灵活回收空闲线程，若无可回收，则创建新线程。
2. newCacheThreadPool将corePoolsize设置为0，MaximumPoolSize设置为Integer.MAX_VALUE，它使用的是**SynchronousQueue** ，也就是说来了任务就创建线程运行，如果线程空闲超过60秒，就销毁线程



## 手动创建

```java
public static void main(String[] args){
        ExecutorService threadPool = new ThreadPoolExecutor(2,
                5,
                1L,
                TimeUnit.SECONDS,
                new LinkedBlockingQueue<>(3),
                Executors.defaultThreadFactory(),
                new ThreadPoolExecutor.DiscardPolicy());

        try{
            for(int i=1;i<=11;i++){
                threadPool.execute(()->{
                    System.out.println(Thread.currentThread().getName()+"\t 办理业务");
                });
            }
        }catch (Exception e){
            e.printStackTrace();
        }finally {
            threadPool.shutdown();
        }
```













