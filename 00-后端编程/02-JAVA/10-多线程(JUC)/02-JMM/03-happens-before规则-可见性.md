## 先行发生原则

==使用happens-before的概念来阐述操作之间的内存可见性.==

在JMM中，如果一个操作执行的结果需要对另一个操作可见，那么这2个操作之间必须要存在happens-before关系。这里提到的2个操作既可以是一个线程之内，也可以是不同线程之间。

因此 JMM 在设计时，定义了如下策略：

> 1. 对于会改变程序执行结果的重排序，JMM 要求编译器和处理器必须禁止这种重排序。
> 2. 对于不会改变程序执行结果的重排序，JMM 对编译器和处理器不做要求（JMM 允许这种重排序）





需要注意的是：
两个操作之间具有happens-before关系，并不意味着前一个操作必须要在后一个操作之前执行！
happens-before仅仅要求前一个操作（执行的结果）对后一个操作可见，且前一个操作按顺序排在第
二个操作之前。





## happens-before 规则(密切相关是前4条)

1. 程序次序规则：一个线程内，按照代码顺序，写在前面的操作  happen-before  写在后面的操作. (即单线程内按代码顺序执行。但是，在不影响在单线程环境执行结果的前提下，编译器和处理器可以进行重排序，这是合法的。换句话说，这一是规则无法保证编译重排和指令重排）。

```java
double pi = 3.14; // A
double r = 1.0; // B
double area = pi * r * r; // C
```

比如上面那三行代码，第一行的 "double pi = 3.14; " happens-before 于 “double r = 1.0;”，这就是规则 1 的内容，比较符合单线程里面的逻辑思维，很好理解。



2. ==锁规则==：对一个锁的解锁，happens-before 于随后对这个锁的加锁。

这个规则中说的锁其实就是 Java 里的 synchronized



3. ==volatile变量规则==：对一个 volatile 域的写，happens-before 于任意后续对这个 volatile 域的读

   简单理解: volatitle变量每次被访问时, 都强迫从主内存中读取,  当变量发生变化时, 总是强迫将最新值刷新到主内存





3. 传递规则：如果 A happens-before B，且 B happens-before C，那么 A happens-before C。

```java
class VolatileExample {
  int x = 0;
  volatile boolean v = false;
  public void writer() {
    x = 42;
    v = true;
  }
  public void reader() {
    if (v == true) {
      // 这里x会是多少呢？
    }
  }
}
```

![](https://youpaiyun.zongqilive.cn/image/20200712165325.png)

从图中，我们可以看到：

> 1. “x=42” Happens-Before 写变量 “v=true” ，这是规则 1 的内容；
> 2. 写变量“v=true” Happens-Before 读变量 “v=true”，这是规则 3 的内容 。
> 3. 再根据这个传递性规则，我们得到结果：“x=42” Happens-Before 读变量“v=true”。这意味着什么呢？

如果线程 B 读到了“v=true”，那么线程 A 设置的“x=42”对线程 B 是可见的。也就是说，线程 B 能看到 “x == 42” 



5. start()规则：它是指主线程 A 启动子线程 B 后，子线程 B 能够看到主线程在启动子线程 B 前的操作。

6.  join()规则: 如果线程 A 执行操作 ThreadB.join()并成功返回，那么线程 B 中的任意操作 happens-before 于线程 A 从 ThreadB.join()操作成功返回。

7. 



```
- 线程中断规则：对线程interrupt()方法的调用先行发生于被中断线程的代码检测到中断事件的发生
- 线程终结规则：线程中所有的操作都先行发生于线程的终止检测，我们可以通过Thread.join()方法结束、Thread.isAlive()的返回值手段检测到线程已经终止执行
- 对象终结规则：对象的构造函数执行结束, 先行发生于他的finalize()方法的开始

```



