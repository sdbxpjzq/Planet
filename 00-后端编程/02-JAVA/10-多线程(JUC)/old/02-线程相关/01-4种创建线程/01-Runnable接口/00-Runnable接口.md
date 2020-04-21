

创建多线程的第二种方式: 实现`Runbable`接口

实现步骤:

1. 创建一个`Runbable`接口的实现类
2. 在实现类中重写`run`方法, 设置线程任务
3. 创建一个`Runnable`接口的实现类对象
4. 创建`Thread`类对象, 构造方法中传递`Runnable`接口的实现类对象
5. 调用`Thread`类中的`start`方法, 开启新的线程执行



代码示例:

```java
public class MyRunnable implements Runnable {
  @Override
  public void run() {
    for (int i = 0; i <20 ; i++) {
      System.out.println(Thread.currentThread().getName() +"run:"+i);
    }
  }
}
```

```java
public class main {
  public static void main(String[] args) {
    // 3.创建Runnable接口的实现类对象
    MyRunnable myRunnable = new MyRunnable();
    // 4. 创建Thread对象, 构造方法传递Runnable接口的实现类对象
    Thread thread = new Thread(myRunnable, "线程1");
    // 5. 调用start
    thread.start();


    for (int i = 0; i <20 ; i++) {
      //System.err.println(Thread.currentThread());
      System.out.println("main:"+i);
    }
  }
}

```

























