> 计数信号量。从概念上讲，信号量维护一组许可。 如果需要，每个acquire（）都会阻塞，直到有许可证可用，然后获取它。 每个release（）添加一个许可，可能会释放一个阻塞的收单机构。 但是，并没有使用实际的许可对象；信号量只是保持一个可用数量的计数，并相应地进行操作。**信号量通常用于限制可以访问某些（物理或逻辑）资源的线程数**。例如，下面是一个类，它使用信号量来控制对项池的访问



```java
public class SemaphoreDemo {
  public static void main(String[] args) {
    // 线程数量：停车位! 限流！
    Semaphore semaphore = new Semaphore(3);

    for (int i = 1; i <=6 ; i++) {
      new Thread(()->{
        // acquire() 得到
        try {
          semaphore.acquire();
          System.out.println(Thread.currentThread().getName()+"抢到车位");
          TimeUnit.SECONDS.sleep(2);
          System.out.println(Thread.currentThread().getName()+"离开车位");
        } catch (InterruptedException e) {
          e.printStackTrace();
        } finally {
          semaphore.release(); // release() 释放
        }
      },String.valueOf(i)).start();
    }
  }
}
```

**原理：**

semaphore.acquire();获得，假设如果已经满了，等待，等待被释放为止！

 semaphore.release();释放，会将当前的信号释放+1，然后唤醒等待的线程！

作用：多个共享资源互斥的使用！并发限流，控制最大的线程数！