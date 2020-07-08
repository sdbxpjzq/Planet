处于`RUNNABLE`状态的线程，当中断线程后，会修改其中断标志位，但并不会影响线程本身。

那我们调用`interrupt()`方法的意义在哪儿？

其实Java是将中断线程的权利交给了我们自己的程序，通过中断标志位，我们的程序可以通过`boolean isInterrupted()`方法来判断当前线程是否中断，从而决定之后的操作

```java
public class MyThread extends Thread{

    @Override
    public void run(){
        while(!this.isInterrupted()){
            System.out.println("exit MyThread");
        }
    }

    public static void main(String[] args) throws InterruptedException {
        Thread thread = new MyThread();
        thread.start();
        System.out.println(thread.getState());

        System.out.println(thread.isInterrupted());
        thread.interrupt();
        System.out.println(thread.isInterrupted());

        thread.join();
        System.out.println(thread.getState());
    }
}
```