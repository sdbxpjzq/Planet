同步方法: `synchronized`修饰的方法, 

格式:

```
public synchronized void method() {
	// 逻辑代码
}
```

## 同步锁是谁?

1. 非`static`方法嘛同步锁 就是`this`
2. `static`方法, 使用当前方法所在类的字节码对象(`类名.class`)

```java
public class MyRunnable implements Runnable {
    private int total = 10;
    // 创建一个锁对象
    Object obj = new Object();
    @Override
    public void run() {
        while (true) {
            method();
        }
    }

    private synchronized void method() {
        if (total > 0) {
            System.out.println("正在卖出票: " + total);
            total--;
        }
    }
}
```

