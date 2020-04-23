同步代码块: `synchronize`关键字可以用于方法中的某个区块中, 表示只对这个区块的组员实现互斥访问

格式:

```
synchronize(同步锁) {
	// 逻辑代码
}
```

## 同步锁

对象的同步锁只是一个概念, 可以想像成 在对象上标记一个锁.

1. 锁对象 可以是任意类型
2. 多个线程对象 要使用同一把锁

注意:

在任何时候, 最多允许一个线程拥有同步锁, 谁拿到锁就进入代码块, 其他的线程只能在外边等着(BLOCKED)



```java
public class MyRunnable implements Runnable {
    private int total = 10;
  	// 创建锁对象
  	Object obj = new Object();
    @Override
    public void run() {
        while (true) {
          // 加锁
            synchronized (obj) {
                if (total > 0) {
                    System.out.println("正在卖出票: " + total);
                    total--;
                }
            }

        }
    }
}

```

