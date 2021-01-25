**AQS**是`AbstractQueuedSynchronizer`的简称，即`抽象队列同步器`

AQS（ AbstractQueuedSynchronizer ）是一个用来构建锁和同步器的抽象框架，只需要继承 AQS 就可以很方便的实现我们自定义的多线程同步器、锁

**AQS 是典型的模板方法设计模式**，父类（AQS）定义好骨架和内部操作细节，具体规则由子类去实现

在 **java.util.concurrent** 包下相关锁、同步器（常用的有 ReentrantLock、 ReadWriteLock、CountDownLatch...）都是基于 AQS 来实现

