## Executors.newCachedThreadPool()

适用:  执行很多短期异步的小程序, 

**特点：**

1. 创建一个可缓存线程池，如果线程池长度超过处理需要，可灵活回收空闲线程，若无可回收，则创建新线程。
2. newCacheThreadPool将corePoolsize设置为`0`，MaximumPoolSize设置为`Integer.MAX_VALUE`，它使用的是**SynchronousQueue** ，也就是说来了任务就创建线程运行，如果线程空闲超过60秒，就销毁线程







