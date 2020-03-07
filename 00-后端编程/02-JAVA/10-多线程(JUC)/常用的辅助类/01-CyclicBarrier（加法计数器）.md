> 一种同步辅助程序，允许一组线程相互等待到达一个公共的屏障点。CyclicBarrier在涉及固定大小的线程方的程序中非常有用，这些线程方有时必须相互等待。这个屏障被称为循环屏障，因为它可以在等待的线程被释放后重新使用。CyclicBarrier支持可选的Runnable命令，该命令在参与方中的最后一个线程到达后，但在释放任何线程之前，每个屏障点运行一次。此屏障操作有助于在任何参与方继续之前更新共享状态。



```java
//加法计数器
public class CyclicBarrierDemo {
  public static void main(String[] args) {
    /**
         * 集齐7颗龙珠召唤神龙
         */
    // 召唤龙珠的线程
    CyclicBarrier cyclicBarrier = new CyclicBarrier(8,()->{
      System.out.println("召唤神龙成功！");
    });

    for (int i = 1; i <=7 ; i++) {
      final int temp = i;
      // lambda能操作到 i 吗
      new Thread(()->{
        System.out.println(Thread.currentThread().getName()+"收集"+temp+"个龙珠");
        try {
          cyclicBarrier.await(); // 等待
        } catch (InterruptedException e) {
          e.printStackTrace();
        } catch (BrokenBarrierException e) {
          e.printStackTrace();
        }
      }).start();
    }
  }
}
```

