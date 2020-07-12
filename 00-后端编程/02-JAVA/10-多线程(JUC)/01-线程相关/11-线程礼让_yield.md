

- 礼让线程, 让当前正在执行的线程暂停, `但不阻塞`
- 将线程从运行状态转为就绪状态
- ==让cpu重新调度, 礼让不一定成功!(看CPU心情)==



```java
public class C1 {
  public static void main(String[] args) throws Exception {

    MyYield myYield = new MyYield();
    new Thread(myYield,"a").start();
    new Thread(myYield,"b").start();

  }
}


class MyYield implements Runnable {
  @Override
  public void run() {
    System.out.println(Thread.currentThread().getName() +"线程开始执行");
    Thread.yield();
    System.out.println(Thread.currentThread().getName() +"线程停止执行");
  }
}

// 这个结果说明 成功
/*
a线程开始执行
b线程开始执行
a线程停止执行
b线程停止执行
*/

// 这个结果说明 没有成功, 又执行了b
/*
a线程开始执行
b线程开始执行
b线程停止执行
a线程停止执行
*/
```

## sleep()和yield()不同

相同 --- 同样都是当前线程会交出处理器资源，

不同 : 

sleep()交出来的时间片其他线程都可以去竞争，也就是说都有机会获得当前线程让出的时间片。

yield()方法只允许与当前线程==具有相同优先级的线程==能够获得释放出来的CPU时间片。















