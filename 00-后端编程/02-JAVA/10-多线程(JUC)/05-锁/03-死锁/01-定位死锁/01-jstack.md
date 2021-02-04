

1. 先找到死锁程序的进程id

   ```
   > jps
   56993 Jps
   56636 Launcher
   57066 DeadLock  //这个就是死锁的进程
   ```

2. 使用jstack -l pid来定位死锁

   ```
   > jstack -l 57066
   
   Found one Java-level deadlock:
   =============================
   "Thread-1":
     waiting to lock monitor 0x00007fbe6d80de18 (object 0x000000076ab33988, a java.lang.Integer),
     which is held by "Thread-0"
   "Thread-0":
     waiting to lock monitor 0x00007fbe6d8106a8 (object 0x000000076ab33998, a java.lang.Integer),
     which is held by "Thread-1"
   
   Java stack information for the threads listed above:
   ===================================================
   "Thread-1":
    at com.rumenz.learn.deadLock.RumenzThread.run(RumenzThread.java:27)
    - waiting to lock <0x000000076ab33988> (a java.lang.Integer)
    - locked <0x000000076ab33998> (a java.lang.Integer)
    at java.lang.Thread.run(Thread.java:748)
   "Thread-0":
    at com.rumenz.learn.deadLock.RumenzThread.run(RumenzThread.java:27)
    - waiting to lock <0x000000076ab33998> (a java.lang.Integer)
    - locked <0x000000076ab33988> (a java.lang.Integer)
    at java.lang.Thread.run(Thread.java:748)
   
   Found 1 deadlock. //发现一个死锁
   ```

   







死锁示例代码

```java
public class RumenzThread implements Runnable{
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
}


public class DeadLock {

  public static void main(String[] args) {
    new Thread(new RumenzThread(1, 2)).start();
    new Thread(new RumenzThread(2, 1)).start();

  }
}
```

