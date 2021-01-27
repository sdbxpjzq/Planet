## 关键点

1. 线程先要获得锁, 必须再锁块中(`synchronized`或`lock`)
2. 必须要先等待 后唤醒, 线程才能够被唤醒



综上: 问题和object中wait和notify一样



```java
public class LockDemo {
    static Object object=new Object();
    public static void main(String[] args) {
        Lock lock=new ReentrantLock();
        Condition condition = lock.newCondition();

        new Thread(()->{
            //如果把下行这句代码打开,先signal后await,会出现A线程一直处于等待状态
            //try { TimeUnit.SECONDS.sleep(3);  } catch (InterruptedException e) {e.printStackTrace();}
            lock.lock();
            try {
                System.out.println(Thread.currentThread().getName()+"\t"+"coming....");
                condition.await();
            }catch (Exception e){
                e.printStackTrace();
            }finally {
                lock.unlock();
            }
            System.out.println(Thread.currentThread().getName()+"\t"+"END....");
        },"A").start();

        new Thread(()->{
            lock.lock();
            try {
                System.out.println(Thread.currentThread().getName()+"\t"+"唤醒A线程****");
                condition.signal();
            }catch (Exception e){
                e.printStackTrace();
            }finally {
                lock.unlock();
            }
        },"B").start();
    }
}

```

