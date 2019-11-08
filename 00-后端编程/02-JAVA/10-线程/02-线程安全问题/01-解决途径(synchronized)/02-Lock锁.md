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























