当线程处于`BLOCKED`状态，说明该线程由于竞争某个对象的锁失败而被挂在了该对象的阻塞队列上了。

那么此时发起中断操作不会对该线程产生任何影响，依然只是设置中断标志位。

```java
**
 * 自定义线程类
 */
public class MyThread extends Thread{

    public synchronized static void doSomething(){
        while(true){
            // 空转
        }
    }
    @Override
    public void run(){
        doSomething();
    }

    public static void main(String[] args) throws InterruptedException {
        // 启动两个线程
        Thread thread1 = new MyThread();
        thread1.start();
        Thread thread2 = new MyThread();
        thread2.start();

        Thread.sleep(1000);
        System.out.println(thread1.getState());
        System.out.println(thread2.getState());

        System.out.println(thread2.isInterrupted());
        thread2.interrupt();
        System.out.println(thread2.isInterrupted());
        System.out.println(thread2.getState());
    }
}

// 输出
/*
RUNNABLE
BLOCKED
false
true
BLOCKED
*/
```

thread2处于`BLOCKED`状态，执行中断操作之后，该线程仍然处于`BLOCKED`状态，但是中断标志位却已被修改。

这种状态下的线程和处于`RUNNABLE`状态下的线程是类似的，给了我们程序更大的灵活性去判断和处理中断。