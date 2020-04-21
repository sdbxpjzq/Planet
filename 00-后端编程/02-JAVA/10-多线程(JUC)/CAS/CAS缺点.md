## 循环时间开销很大

```java
/**CAS中有个do while 方法 ：如果CAS失败，会一直进行尝试，如果CAS长时间一直不成功，会给CPU带来很大的开销*/
public final int getAndAddInt(Object var1, long var2, int var4) {
  int var5;
  // 自旋锁
  do {
    var5 = this.getIntVolatile(var1, var2);
  } while(!this.compareAndSwapInt(var1, var2, var5, var5 + var4));
  return var5;
}

```

## 一次性只能保证一个共享变量的原子性

只能保证一个共享变量的原子性 当对一个共享变量执行操作的时候，我们可以使用循环CAS的方式来保证原子操作，但是对多个共享变量操作时，循环CAS就无法保证操作的原子性，这个时候就可以用锁来保证原子性。

## 存在ABA问题

- 何为ABA问题： 在一个时间差的时段内会造成数据的变化。比如说一个线程AA从内存中取走A，这个时候另一个线程BB也从内存中取走A，这个时候A的值为X，然后线程BB将A的值改为Y，过一会又将A的值改为X，这个时候线程AA回来进行CAS操作发现内存中A的值仍然是X，因此线程AA操作成功。**但是尽管线程AA的CAS操作成功，但是不代表这个过程就是没问题的**




![](https://youpaiyun.zongqilive.cn/image/20200421185153.png)



### 原子引用(解决方案)

解决ABA 问题，引入原子引用！对应的思想：乐观锁！

带版本号 的原子操作！--`AtomicStampedReference`

```java
public class CASDemo {

  //AtomicStampedReference 注意，如果泛型是一个包装类，注意对象的引用问题

  // 正常在业务操作，这里面比较的都是一个个对象
  static AtomicStampedReference<Integer> atomicStampedReference = new AtomicStampedReference<>(1,1);

  // CAS  compareAndSet : 比较并交换！
  public static void main(String[] args) {

    new Thread(()->{
      int stamp = atomicStampedReference.getStamp(); // 获得版本号
      System.out.println("a1=>"+stamp);

      try {
        TimeUnit.SECONDS.sleep(1);
      } catch (InterruptedException e) {
        e.printStackTrace();
      }
      Lock lock = new ReentrantLock(true);
      atomicStampedReference.compareAndSet(1, 2,
                                           atomicStampedReference.getStamp(), atomicStampedReference.getStamp() + 1);

      System.out.println("a2=>"+atomicStampedReference.getStamp());

      System.out.println(atomicStampedReference.compareAndSet(2, 1,
                                                              atomicStampedReference.getStamp(), atomicStampedReference.getStamp() + 1));
      System.out.println("a3=>"+atomicStampedReference.getStamp());

    },"a").start();

    // 乐观锁的原理相同！
    new Thread(()->{
      int stamp = atomicStampedReference.getStamp(); // 获得版本号
      System.out.println("b1=>"+stamp);

      try {
        TimeUnit.SECONDS.sleep(2);
      } catch (InterruptedException e) {
        e.printStackTrace();
      }

      System.out.println(atomicStampedReference.compareAndSet(1, 6,
                                                              stamp, stamp + 1));

      System.out.println("b2=>"+atomicStampedReference.getStamp());

    },"b").start();

  }
}
```

```java
import java.util.concurrent.TimeUnit;
import java.util.concurrent.atomic.AtomicReference;
import java.util.concurrent.atomic.AtomicStampedReference;

/**
 * ABA问题解决
 * AtomicStampedReference
 */
public class ABADemo {
  static AtomicReference<Integer> atomicReference = new AtomicReference<>(100);
  static AtomicStampedReference<Integer> atomicStampedReference = new AtomicStampedReference<>(100, 1);

  public static void main(String[] args) {
    System.out.println("=====以下时ABA问题的产生=====");
    new Thread(() -> {
      atomicReference.compareAndSet(100, 101);
      atomicReference.compareAndSet(101, 100);
    }, "Thread 1").start();

    new Thread(() -> {
      try {
        //保证线程1完成一次ABA操作
        TimeUnit.SECONDS.sleep(1);
      } catch (InterruptedException e) {
        e.printStackTrace();
      }
      System.out.println(atomicReference.compareAndSet(100, 2019) + "\t" + atomicReference.get());
    }, "Thread 2").start();
    try {
      TimeUnit.SECONDS.sleep(2);
    } catch (InterruptedException e) {
      e.printStackTrace();
    }
    System.out.println("=====以下时ABA问题的解决=====");

    new Thread(() -> {
      int stamp = atomicStampedReference.getStamp();
      System.out.println(Thread.currentThread().getName() + "\t第1次版本号" + stamp);
      try {
        TimeUnit.SECONDS.sleep(2);
      } catch (InterruptedException e) {
        e.printStackTrace();
      }
      atomicStampedReference.compareAndSet(100, 101, atomicStampedReference.getStamp(), atomicStampedReference.getStamp() + 1);
      System.out.println(Thread.currentThread().getName() + "\t第2次版本号" + atomicStampedReference.getStamp());
      atomicStampedReference.compareAndSet(101, 100, atomicStampedReference.getStamp(), atomicStampedReference.getStamp() + 1);
      System.out.println(Thread.currentThread().getName() + "\t第3次版本号" + atomicStampedReference.getStamp());
    }, "Thread 3").start();

    new Thread(() -> {
      int stamp = atomicStampedReference.getStamp();
      System.out.println(Thread.currentThread().getName() + "\t第1次版本号" + stamp);
      try {
        TimeUnit.SECONDS.sleep(4);
      } catch (InterruptedException e) {
        e.printStackTrace();
      }
      boolean result = atomicStampedReference.compareAndSet(100, 2019, stamp, stamp + 1);

      System.out.println(Thread.currentThread().getName() + "\t修改是否成功" + result + "\t当前最新实际版本号：" + atomicStampedReference.getStamp());
      System.out.println(Thread.currentThread().getName() + "\t当前最新实际值：" + atomicStampedReference.getReference());
    }, "Thread 4").start();
  }
}
```

































