`java.util.concurrent,locks.Lock`机制提供了比`synchronized`更广泛的锁定操作, `synchronized`具有的功能`Lock`都有, 除此之外更强大, 更体现 面向对象

`Lock锁`也称`同步锁`,加锁与释放锁方法, 如下:



- `public void lock()` 加同步锁
- `public void unlock()` 释放同步锁



## 使用步骤

1. 创建一个`ReentrantLock`对象
2. 在问题代码 `前` 调用`lock()`获取锁
3. 在问题代码 `后` 调用`unlock()`释放锁



```java
public class MyRunnable implements Runnable {
    private int total = 10;
  
  	// 创建 ReentrantLock对象
    Lock l = new ReentrantLock();

    @Override
    public void run() {
        while (true) {
          // 加锁
            l.lock();
            try {
              if (total > 0) {
                System.out.println("正在卖出票: " + total);
                total--;
            	}
            } finally {
              // 最好放到 finally 中释放锁
              l.unlock();
            }
            
        }
    }

}
```

## *实现类：可重入锁、读锁、写锁*

![](https://youpaiyun.zongqilive.cn/image/20200307104430.png)

`ReentrantLock `的两种构造实现

```java

public ReentrantLock() {
        sync = new NonfairSync();//非公平锁（默认）
    }

    /**
     * Creates an instance of {@code ReentrantLock} with the
     * given fairness policy.
     *
     * @param fair {@code true} if this lock should use a fair ordering policy
     */
    public ReentrantLock(boolean fair) {//公平锁
        sync = fair ? new FairSync() : new NonfairSync();
    }
```

公平锁：十分公平：可以先来后到

非公平锁：十分不公平：可以插队 （默认）

## 代码示例

```java
public class SaleTicketDemo02  {
  public static void main(String[] args) {
    // 并发：多线程操作同一个资源类, 把资源类丢入线程
    Ticket2 ticket = new Ticket2();
    // @FunctionalInterface 函数式接口，jdk1.8  lambda表达式 (参数)->{ 代码 }
    new Thread(()->{for (int i = 1; i < 40 ; i++) ticket.sale();},"A").start();
    new Thread(()->{for (int i = 1; i < 40 ; i++) ticket.sale();},"B").start();
    new Thread(()->{for (int i = 1; i < 40 ; i++) ticket.sale();},"C").start();
  }
}
// Lock三部曲
// 1、 new ReentrantLock();
// 2、 lock.lock(); // 加锁
// 3、 finally=>  lock.unlock(); // 解锁
class Ticket2 {
  // 属性、方法
  private int number = 30;

  Lock lock = new ReentrantLock();

  public void sale(){
    lock.lock(); // 加锁
    try {
      // 业务代码
      if (number>0){
        System.out.println(Thread.currentThread().getName()+"卖出了"+(number--)+"票,剩余："+number);
      }
    } catch (Exception e) {
      e.printStackTrace();
    } finally {
      lock.unlock(); // 解锁
    }
  }
}
```



































