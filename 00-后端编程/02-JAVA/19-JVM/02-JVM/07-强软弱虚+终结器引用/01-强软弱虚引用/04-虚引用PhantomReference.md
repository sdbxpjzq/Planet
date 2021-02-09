## 虚引用

![](https://youpaiyun.zongqilive.cn/image/20210207194704.png)



![](https://youpaiyun.zongqilive.cn/image/20200605165958.png)

![](https://youpaiyun.zongqilive.cn/image/20200605185126.png)



顾名思义，就是形同虚设，与其他集中不同，虚引用并不会决定对象的生命周期

- 虚引用需要java.lang.ref.PhantomReference类来实现。
- 如果一个对象持有虚引用，那么他就和没有任何引用一样，在任何时候都可能被垃圾回收器回收，他不能单独使用也不能通过它访问对象，虚引用和引用队列（ReferenceQueeu)联合使用。
- 虚引用的主要作用是跟踪对象被垃圾回收的状态，仅仅是提供了一种确保对象被finalize以后，做某些事情的机制。PhantomReference的get方法总是返回null，因此无法访问对应的引用对象。其意义在于**说明一个对象已经进入finalization阶段，可以被gc回收，用来实现比finalization机制更灵活的回收操作。**

换句话说，设置虚引用关联的唯一目的，就是这个对象被收集器回收的时候收到一个系统通知或者后续添加进一步的处理。

java允许使用`finalize()`方法在垃圾收集器将对象从内存中清除出去之前做必要的清理工作。



![](https://youpaiyun.zongqilive.cn/image/20200425140359.png)



```java
class PhantomReferenceTest {
  public static PhantomReferenceTest obj; //当前类对象的声明
  static ReferenceQueue<PhantomReferenceTest> phantomQueue = null;

  public static class CheckRefQueue extends Thread {
    @Override
    public void run() {
      while (true) {
        if (phantomQueue != null) {
          PhantomReference<PhantomReferenceTest> objt = null;
          try {
            objt = (PhantomReference<PhantomReferenceTest>) phantomQueue.remove();
          } catch (InterruptedException e) {
            e.printStackTrace();
          }
          if (objt != null) {
            System.out.println("追踪垃圾回收过程: PhantomReferenceTest实例被GC了");
          }
        }
      }
    }
  }

  @Override
  protected void finalize() throws Throwable {
    super.finalize();
    System.out.println("调用当前类的finalize()方法");
    obj = this;
  }

  public static void main(String[] args) {
    Thread t = new CheckRefQueue();
    t.setDaemon(true);// 设置为守护进程, 当程序中没有非守护线程时, 守护线程也就执行结束
    t.start();

    phantomQueue = new ReferenceQueue<>();
    obj = new PhantomReferenceTest();
    // 构造了 PhantomReferenceTest 对象的虚引用, 并指定了引用队列
    PhantomReference<PhantomReferenceTest> phantomRef = new PhantomReference<>(obj, phantomQueue);

    //不可获取虚引用中的对象
    System.out.println(phantomRef.get());// null
    // 将强引用去除
    obj = null;
    // 第一次进行GC, 由于对象可复活, GC无法回收该对象
    System.gc();
    try {
      TimeUnit.SECONDS.sleep(1);
    } catch (InterruptedException e) {
      e.printStackTrace();
    }
    if (obj == null) {
      System.out.println("obj 是 null");
    } else {
      System.out.println("obj 可用");
    }


    System.out.println("第2次GC");
    obj = null;
    System.gc();
    try {
      TimeUnit.SECONDS.sleep(1);
    } catch (InterruptedException e) {
      e.printStackTrace();
    }

  }
}
```

