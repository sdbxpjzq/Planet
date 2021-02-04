

```java
import java.lang.management.ManagementFactory;
import java.lang.management.ThreadInfo;
import java.lang.management.ThreadMXBean;
import java.util.concurrent.TimeUnit;

public class RumenzThread implements Runnable {
  int a,b;

  public RumenzThread(int a, int b) {
    this.a = a;
    this.b = b;
  }

  @Override
  public void run() {
    //Integer.valueOf(a) 包装成对象
    synchronized (Integer.valueOf(a)){
      try{
        //睡眠3秒,增加死锁的几率
        Thread.sleep(3000);
      }catch (Exception e){
        e.printStackTrace();
      }
      synchronized (Integer.valueOf(b)){
        System.out.println("a+b="+(a+b));
      }
    }

  }

  @SneakyThrows
  public static void main(String[] args) {
    new Thread(new RumenzThread(1, 2)).start();
    new Thread(new RumenzThread(2, 1)).start();

    TimeUnit.SECONDS.sleep(3);
    // 检查死锁
    ThreadMXBean threadMXBean = ManagementFactory.getThreadMXBean();
    long[] deadlockedThreads = threadMXBean.findDeadlockedThreads();
    if (deadlockedThreads != null && deadlockedThreads.length > 0) {
      for (int i = 0; i < deadlockedThreads.length; i++) {
        //第二个参数指定转储多少项堆栈跟踪信息,设置为Integer.MAX_VALUE可以转储所有的堆栈跟踪信息
        ThreadInfo threadInfo = threadMXBean.getThreadInfo(deadlockedThreads[i], Integer.MAX_VALUE);
        System.out.println("发现死锁" + threadInfo.getThreadName());
        System.out.println(threadInfo);
      }
    }
  }
}
```

