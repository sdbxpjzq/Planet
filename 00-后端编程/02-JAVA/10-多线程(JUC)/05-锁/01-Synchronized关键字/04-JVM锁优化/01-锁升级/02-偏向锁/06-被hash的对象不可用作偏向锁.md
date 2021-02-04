## 被hash的对象不可用作偏向锁



如果一个对象处于偏向状态(匿名偏向、可重偏向、已偏向)，那么该对象的MarkWord中原本预存hashcode的bit位却用来存放或者将要存放所偏向线程的thread ID了，此时该对象如果进行hash运算所生成的hash值无处存放，这就是导致为什么偏向锁对象不能进行hash运算。-----个人理解，有误请指正



```java
/**
 * 对象执行hashcode()方法不可用作偏向锁
 */
// -XX:BiasedLockingStartupDelay=0  jvm关闭偏向锁延迟
public class JOLExample3 {
    public static void main(String[] args) throws InterruptedException {
         // Thread.sleep(5000); // 超过4s延迟，对象开启的是偏向锁
         A a = new A();
         a.hashCode();
        System.out.println("before lock");
        System.out.println(ClassLayout.parseInstance(a).toPrintable());
        synchronized (a) {
            System.out.println("locking");
            System.out.println(ClassLayout.parseInstance(a).toPrintable());
        }
    }
}
```

![](https://youpaiyun.zongqilive.cn/image/20200711192949.png)

