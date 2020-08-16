![](https://youpaiyun.zongqilive.cn/image/20200808162922.png)

EagerThreadPoolExecutor线程池通过自定义队列的这么一种形式，改写了线程池的机制。这种线程池的机制是核心线程数不够了，先起线程，当线程达到最大值后，后面的任务就丢进队列！(这里与JDK默认的有区别)

