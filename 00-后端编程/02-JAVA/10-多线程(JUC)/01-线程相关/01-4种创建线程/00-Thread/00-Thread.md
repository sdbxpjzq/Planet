使用`java.lang.Thread`类代表线程

所有的线程对象都必须是`Thread`类或其子类的实例.

通过继承`Thread`类来创建并启动多线程的步骤如下:

实现步骤:

1. 创建一个Thread类的子类

2. 在Thread类的子类中重写Thread类中的run方法,设置线程任务(开启线程要做什么?)

3.  创建Thread类的子类对象

4. 调用Thread类中的方法start方法,开启新的线程,执行run方法
     `void start()` 使该线程开始执行；Java 虚拟机调用该线程的 run 方法。

   

   结果是两个线程并发地运行；当前线程（main线程）和另一个线程（创建的新线程,执行其 run 方法）

   

   多次启动一个线程是非法的。特别是当线程已经结束执行后，不能再重新启动。

   

   java程序属于抢占式调度,那个线程的优先级高,那个线程优先执行;

   同一个优先级,随机选择一个执行



```java
//1.创建一个Thread类的子类
public class MyMyThread extends Thread{
    //2.在Thread类的子类中重写Thread类中的run方法,设置线程任务(开启线程要做什么?)
    @Override
    public void run() {
        for (int i = 0; i <20 ; i++) {
            System.out.println("run:"+i);
        }
    }
}
```

```java
public class Demo01Thread {
    public static void main(String[] args) {
        //3.创建Thread类的子类对象
        MyThread mt = new MyThread();
        //4.调用Thread类中的方法start方法,开启新的线程,执行run方法
        mt.start();

        // 主线程继续执行
        for (int i = 0; i <20 ; i++) {
            System.out.println("main:"+i);
        }
    }
}
```

![](https://pic.superbed.cn/item/5dc3de148e0e2e3ee95a2d47.jpg)

