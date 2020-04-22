- `CyclicBarrier` 的字面意思是可循环(Cyclic)使用的屏障(Barrier)。它要做的事情是，让一组线程到达一个屏障（也可以叫做同步点）时被阻塞，知道最后一个线程到达屏障时，屏障才会开门，所有被屏障拦截的线程才会继续干活，线程进入屏障通过CyclicBarrier的`await()`方法。
- 做加法

- 例子：  集齐7颗龙珠召唤神龙

```java
//加法计数器
public class CyclicBarrierDemo {
  public static void main(String[] args) {
    /**
         * 集齐7颗龙珠召唤神龙
         */
    // 召唤龙珠的线程
    CyclicBarrier cyclicBarrier = new CyclicBarrier(7,()->{
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

