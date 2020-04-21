```
一种同步辅助程序，允许一个或多个线程等待在其它线程中执行的一组操作完成。使用给定的计数初始化CountDownLatch。由于调用了countDown（）方法，await方法阻塞直到当前计数为零，之后释放所有等待线程，并立即返回await的任何后续调用。这是一个一次性现象——计数不能重置。如果需要重置计数的版本，请考虑使用CyclicBarrier。倒计时锁存器是一种通用的同步工具，可用于多种目的。使用计数1初始化的倒计时锁存器用作简单的开/关锁存器或门：调用倒计时（）的线程打开它之前，调用它的所有线程都在门处等待。初始化为N的倒计时锁存器可用于使一个线程等待N个线程完成某个操作或某个操作已完成N次。倒计时锁存器的一个有用特性是，它不要求调用倒计时的线程在继续之前等待计数达到零，它只是防止任何线程在所有线程都可以通过之前继续通过等待。
```

```java

// 计数器
public class CountDownLatchDemo {
  public static void main(String[] args) throws InterruptedException {
    // 总数是6，必须要执行任务的时候，再使用！
    CountDownLatch countDownLatch = new CountDownLatch(6);

    for (int i = 1; i <=6 ; i++) {
      new Thread(()->{
        System.out.println(Thread.currentThread().getName()+" Go out");
        countDownLatch.countDown(); // 数量-1
      },String.valueOf(i)).start();
    }
    countDownLatch.await(); // 等待计数器归零，然后再向下执行
    System.out.println("Close Door");
  }
}
```

***原理：***

countDownLatch.countDown(); // 数量-1

countDownLatch.await(); // 等待计数器归零，然后再向下执行

每次有线程调用 countDown() 数量-1，假设计数器变为0，countDownLatch.await() 就会被唤醒，继续 执行！



