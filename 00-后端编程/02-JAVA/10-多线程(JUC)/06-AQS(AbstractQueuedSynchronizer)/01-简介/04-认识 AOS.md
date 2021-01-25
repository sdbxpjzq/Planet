抽象类 AQS 同样继承自抽象类 AOS（AbstractOwnableSynchronizer）

AOS 内部只有一个 Thread 类型的变量，提供了获取和设置当前独占锁线程的方法

主要作用是 **记录当前占用独占锁（互斥锁）的线程实例**



```java
public abstract class AbstractOwnableSynchronizer implements java.io.Serializable {
    // 独占线程（不参与序列化）
    private transient Thread exclusiveOwnerThread;
    // 设置当前独占的线程
    protected final void setExclusiveOwnerThread(Thread thread) {
        exclusiveOwnerThread = thread;
    }
    // 返回当前独占的线程
    protected final Thread getExclusiveOwnerThread() {
        return exclusiveOwnerThread;
    }
}
```

