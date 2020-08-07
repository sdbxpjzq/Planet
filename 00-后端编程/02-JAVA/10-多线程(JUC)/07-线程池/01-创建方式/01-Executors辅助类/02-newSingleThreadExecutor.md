## Executors.newSingleThreadExecutor()

适用: 一个任务一个任务执行的场景

**特点：**

1. 创建`一个单线程化的线程池`，它只会用唯一的工作线程来执行任务，保证所有任务都按照指定的顺序执行。
2. newSingleThreadExecutor将corePoolSize和MaximumPoolSize都设置为`1`，它使用的是**LinedBlockingQueue** 。

