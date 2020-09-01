`interrupt()`; 中断一个线程, 并不是强制关闭这个线程, 打招呼, 中断标志位 设置为true

`isInterrupt()`: 判定当前线程是否处于中断状态

`static方法interrupted()`: 读取并清除当前线程的终止状态值。也就是如果状态值为 true，该方法需要将状态值置回 false 然后返回 true。



interrupt()方法仅仅是通知线程，线程有机会执行一些后续操作，同时也可以无视这个通知。被interrupt的线程，有两种方式接收通知：**一种是异常， 另一种是主动检测。**

#### 通过异常接收通知

当线程A处于WAITING、 TIMED_WAITING状态时， 如果其他线程调用线程A的interrupt()方法，则会使线程A返回到RUNNABLE状态，同时线程A的代码会触发InterruptedException异常。线程转换到WAITING、TIMED_WAITING状态的触发条件，都是调用了类似wait()、join()、sleep()这样的方法， 我们看这些方法的签名时，发现都会throws InterruptedException这个异常。这个异常的触发条件就是：其他线程调用了该线程的interrupt()方法。

当线程A处于RUNNABLE状态时，并且阻塞在java.nio.channels.InterruptibleChannel上时， 如果其他线程调用线程A的interrupt()方法，线程A会触发java.nio.channels.ClosedByInterruptException这个异常；当阻塞在java.nio.channels.Selector上
时，如果其他线程调用线程A的interrupt()方法，线程A的java.nio.channels.Selector会立即返回。



#### 主动检测通知

如果线程处于RUNNABLE状态，并且没有阻塞在某个I/O操作上，例如中断计算基因组序列的线程A，此时就得依赖线程A主动检测中断状态了。如果其他线程调用线程A的interrupt()方法， 那么线程A可以通过isInterrupted()方法， 来检测自己是不是被中断了。











