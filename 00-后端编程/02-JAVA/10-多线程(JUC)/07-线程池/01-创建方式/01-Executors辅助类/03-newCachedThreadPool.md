## Executors.newCachedThreadPool()

适用:  执行很多短期异步的小程序, 

**特点：**

1. 创建一个可缓存线程池，如果线程池长度超过处理需要，可灵活回收空闲线程，若无可回收，则创建新线程。
2. newCacheThreadPool将corePoolsize设置为`0`，MaximumPoolSize设置为`Integer.MAX_VALUE`，它使用的是**SynchronousQueue** ，也就是说来了任务就创建线程运行，如果线程空闲超过60秒，就销毁线程



newCachedThreadPool： 按需要创建新线程的线程池。核心线程数为0，最大线程数为 Integer.MAX_VALUE，keepAliveTime为60秒，工作队列使用同步移交 SynchronousQueue。该线程池可以无限扩展，当需求增加时，可以添加新的线程，而当需求降低时会自动回收空闲线程。适用于执行很多的短期异步任务，或者是负载较轻的服务器。



