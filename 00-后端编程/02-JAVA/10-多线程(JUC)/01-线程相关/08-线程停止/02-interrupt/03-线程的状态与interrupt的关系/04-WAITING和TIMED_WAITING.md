如果一个线程在处于 **wait() / sleep() / join(**) 调用时的阻塞状态，那么interrupt() 会让其**退出阻塞**，并且**清除中断状态**，并且会收到一个 **InterruptedException**。



这两种状态本质上是同一种状态，只不过`TIMED_WAITING`在等待一段时间后会自动释放自己，而`WAITING`则是无限期等待，需要其他线程调用类似`notify`方法释放自己。但是他们都是线程在运行的过程中由于缺少某些条件而被挂起在某个对象的等待队列上。

当这些线程遇到中断操作的时候，会抛出一个`InterruptedException`异常，并清空中断标志位。例如：

```java
public class MyThread extends Thread{

    @Override
    public void run(){
        synchronized (this){
            try {
                wait();
            } catch (InterruptedException e) {
                System.out.println("catch InterruptedException");
              // 再次 恢复当前线程的 中断状态
              	interrupt();
            }
        }
    }

    public static void main(String[] args) throws InterruptedException {
        Thread thread = new MyThread();
        thread.start();

        Thread.sleep(1000);
        System.out.println(thread.getState());

        System.out.println(thread.isInterrupted());
        thread.interrupt();
        Thread.sleep(1000);
        System.out.println(thread.isInterrupted());
    }
}
```

从运行结果看，当线程启动之后就被挂起到该线程对象的等待队列上，然后我们调用`interrupt()`方法对该线程进行中断，输出了我们在catch中的输出语句，显然是捕获了`InterruptedException`异常，接着就看到该线程的中断标志位被清空。

因此我们要么就在`catch`语句中结束线程，否则就在`catch`语句中加上`this.interrupt();`，再次设置标志位，这样也方便在之后的逻辑或者其他地方继续判断。