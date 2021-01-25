AQS 使用一个 Volatile 修饰的 int 类型的成员变量 State 来表示同步状态，修改同步状态成功即为获得锁

```java
private volatile int state;
// state 默认值是0 , state>=1, 说明有锁
```

Volatile 保证了变量在多线程之间的可见性，修改 State 值时通过 CAS 机制来保证修改的原子性



如果共享资源被占用，需要一定的阻塞等待唤醒机制来保证锁的分配，AQS 中会将竞争共享资源失败的线程添加到一个`变体的 CLH 队列`中

![](https://youpaiyun.zongqilive.cn/image/20210124162925.png)

```java
// 关于支撑 AQS 特性的重要方法及属性如下：
public abstract class AbstractQueuedSynchronizer 
  extends AbstractOwnableSynchronizer implements java.io.Serializable {
   // CLH 变体队列头、尾节点
    private transient volatile Node head;
   private transient volatile Node tail;
   // AQS 同步状态
    private volatile int state;
   // CAS 方式更新 state
   protected final boolean compareAndSetState(int expect, int update) {
        return unsafe.compareAndSwapInt(this, stateOffset, expect, update);
    }
}
```

