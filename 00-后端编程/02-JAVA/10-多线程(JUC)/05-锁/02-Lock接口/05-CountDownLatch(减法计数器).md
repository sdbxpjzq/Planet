- 让一些线程阻塞直到另外一些线程完成后才别唤醒

- `CountDownLatch`主要有两个方法，当一个或多个线程调用**`await`** 方法时，调用线程会被阻塞，其他线程调用**`countDown`** 方法计数器减`1`（调用**`countDown`** 方法时线程不会阻塞），当计数器的值变为`0`，因调用**`await`** 方法被阻塞的线程会被唤醒，进而继续执行。
- 多线程, 倒计时

- 关键点： 1）**`await()`**  方法 2） **`countDown()`**  方法

例子：一个教室有1个班长和若干个学生，班长要等所有学生都走了才能关门，那么要如何实现。

```java
//没有使用CountDownLatch
public class CountDownLanchDemo {
  public static void main(String[] args) {
    for (int i = 0; i < 6; i++) {
      new Thread(() -> {
        System.out.println(Thread.currentThread().getName() + " 离开了教室...");
      }, i+"号学生").start();
    }
    System.out.println("========班长锁门========");
  }

}
//打印结果
/**
	0号学生 离开了教室...
	4号学生 离开了教室...
	3号学生 离开了教室...
	2号学生 离开了教室...
	========班长锁门========
	1号学生 离开了教室...
	5号学生 离开了教室...
*/
//可以看出班长走之后还有两个学生被锁在了教室

//=====解决方法=====
public static void main(String[] args) {
  try {
    CountDownLatch countDownLatch = new CountDownLatch(6);
    for (int i = 0; i < 6; i++) {
      new Thread(() -> {
        countDownLatch.countDown();
        System.out.println(Thread.currentThread().getName() + " 离开了教室...");
      }, i + "号学生").start();
    }
    countDownLatch.await(); //这里相当于挡住，在countDownLatch还没有变0之前不能执行以下方法
    System.out.println("========班长锁门========");
  } catch (InterruptedException e) {
    e.printStackTrace();
  }
}
//打印结果
/**
	0号学生 离开了教室...
	3号学生 离开了教室...
	2号学生 离开了教室...
	1号学生 离开了教室...
	4号学生 离开了教室...
	5号学生 离开了教室...
	========班长锁门========
*/
//可以看出班长等学生都走了才锁门

```

