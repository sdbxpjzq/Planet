## 关键点

1. `wait`和`notify`方法==必须要在同步块或同步方法里且成对出现使用==, 否则抛出异常`java.lang.IllegalMonitorStateException`

2. ==先wait后notify才可以== (如果先notify后wait会出现另一个线程一直处于等待状态)

3. synchronized是关键字属于JVM层面。monitorenter(底层是通过monitor对象来完成,其实wait/notify等方法也依赖monitor对象只能在同步块或方法中才能调用wait/notify等方法)

   



```java
public class SynchronizedDemo {
    //等待线程
    public void waitThread(){
//      1.如果将synchronized (this){}注释,会抛出异常,因为wait和notify一定要在同步块或同步方法中
        synchronized (this){
            try {
                System.out.println(Thread.currentThread().getName()+"\t"+"coming....");
                wait();
            } catch (InterruptedException e) {
                e.printStackTrace();
            }
            System.out.println(Thread.currentThread().getName()+"\t"+"end....");
        }
    }
    //唤醒线程
    public void notifyThread(){
        synchronized (this){
            System.out.println("唤醒A线程....");
            notify();
        }
    }
    public static void main(String[] args) {
        SynchronizedDemo synchronizedDemo = new SynchronizedDemo();
        new Thread(()->{

//            2.如果把下行这句代码打开,先notify后wait,会出现A线程一直处于等待状态
//            try { TimeUnit.SECONDS.sleep(3);  } catch (InterruptedException e) {e.printStackTrace();}
            synchronizedDemo.waitThread();
        },"A").start();
        new Thread(()->{
            synchronizedDemo.notifyThread();
        },"B").start();
    }
}

```



   

   

   

   