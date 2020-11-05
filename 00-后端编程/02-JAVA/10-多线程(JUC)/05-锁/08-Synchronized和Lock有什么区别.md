## 区别

#### 原始构成

1. `synchronized`  内置的Java关键字，属于JVM层面

2. ` Lock `是一个Java具体类(`java.util.concurrent.locks.Lock`), 是API层面

#### 使用方面

1. `synchronized` 不需要手动释放锁, 
2. `ReentrantLock` 需要手动释放锁,  否则会出现死锁现象



#### 等待是否可中断

1. `synchronized`不可中断, 除非抛出异常或者正常运行完成, 否则只能阻塞等待
2. `ReentrantLock`可中断
   1. 设置超时 `tryLock(Long time, TimeUnit unit)`
   2. `lockInterruptibly()`放在代码块中, 调用`interrupt()`可中断



#### 加锁是否公平

1. `synchronized`非公平锁
2. `ReentrantLock`两个都可以, 默认非公平锁



#### 锁定多个条件`Condition`

1. `synchronized` 无法精确唤醒, 要么随机唤醒一个线程, 要么唤醒全部线程
2. `ReentrantLock` 可以精确唤醒, 



#### 获取锁状态

1. `synchronized`  无法判断获取锁的状态，
2. Lock  可以判断线程是否获取到了锁



<img src="https://youpaiyun.zongqilive.cn/image/20200713090937.png" style="zoom:200%;" />



## synchronized

![](https://youpaiyun.zongqilive.cn/image/20200422164841.png)

![](https://youpaiyun.zongqilive.cn/image/20200422164849.png)

![](https://youpaiyun.zongqilive.cn/image/20200422164933.png)



## Lock

![](https://youpaiyun.zongqilive.cn/image/20200422165009.png)

