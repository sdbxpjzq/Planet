ThreadLocal是给每一个线程都创建变量的副本，保证每个线程访问都是自己的副本，相互隔离，就不会出现线程安全问题，这种方式其实用空间换时间的做法。

线程改变只会影响自己的副本，不会影响主线程原始变量



![](https://youpaiyun.zongqilive.cn/image/20201214103012.png)



```java
public class ThreadLocalDemo {
  /**
  static 是为了确保全局只有一个保存 String 对象的 ThreadLocal 实例；
  final 确保 ThreadLocal 的实例不可更改，防止被意外改变，导致放入的值和取出来的不一致，另外还能防止 ThreadLocal 的内存泄漏。
     */
  public static final ThreadLocal<String> THREAD_LOCAL = new ThreadLocal<>();

  public static void main(String[] args) throws Exception {
    new ThreadLocalDemo().threadLocalTest();
  }

  public void threadLocalTest() throws Exception {
    // 主线程设置值
    THREAD_LOCAL.set("wupx");
    String v = THREAD_LOCAL.get();
    System.out.println("Thread-0线程执行之前，" + Thread.currentThread().getName() + "线程取到的值：" + v);

    new Thread(new Runnable() {
      @Override
      public void run() {
        String v = THREAD_LOCAL.get();
        System.out.println(Thread.currentThread().getName() + "线程取到的值：" + v);
        // 设置 threadLocal
        THREAD_LOCAL.set("huxy");
        v = THREAD_LOCAL.get();
        System.out.println("重新设置之后，" + Thread.currentThread().getName() + "线程取到的值为：" + v);
        System.out.println(Thread.currentThread().getName() + "线程执行结束");
      }
    }).start();
    // 等待所有线程执行结束
    Thread.sleep(3000L);
    v = THREAD_LOCAL.get();
    System.out.println("Thread-0线程执行之后，" + Thread.currentThread().getName() + "线程取到的值：" + v);
  }
}
```





