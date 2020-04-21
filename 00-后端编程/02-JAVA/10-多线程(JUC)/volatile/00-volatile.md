`Volatile`是java虚拟机提供 **轻量级的同步机制**

## 三大特性

### **保证可见性**

`JMM模型的线程工作：` 各个线程对主内存中共享变量X的操作都是各个线程各自拷贝到自己的工作内存操作后再协会主内存中。

`存在的问题：` 如果一个线程A 修改了共享变量X的值还未写回主内存，这是另外一个线程B又对内存中的一个共享变量X进行操作，但是此时线程A工作内存中的共享变量对线程B来说事并不可见的。这种工作内存与主内存延迟的现象就会造成了可见性的问题。

`解决（volatile）：` 当多个线程访问同一个变量时，一个线程修改了这个变量的值，其他线程能够立即看到修改的值

```java
import java.util.concurrent.TimeUnit;

public class main {
  // 不加 volatile 程序就会死循环！
  // 加 volatile 可以保证可见性, 及时通知其他线程,主物理内存的值已经被修改
  private volatile static int num = 0;

  public static void main(String[] args) { // main

    new Thread(()->{ // 线程 A 对主内存的变化不知道的
      while (num==0){
        System.out.println(Thread.currentThread().getName() + " : "+ num);
      }
      System.out.println(Thread.currentThread().getName() + " : "+ num);

    },"A").start();

    try {
      TimeUnit.SECONDS.sleep(1);
    } catch (InterruptedException e) {
      e.printStackTrace();
    }
    num = 1;
    System.out.println(Thread.currentThread().getName()+" : "+num);
  }
}
```

### 不保证原子性

线程A在执行任务的时候，不能被打扰的，也不能被分割。要么同时成功，要么同时失败。

- `原子性：` 不可分割、完整性，即某个线程正在做某个具体业务时，中间不可以被加塞或者被分割，需要整体完整，要么同时成功，要么同时失败
- `解决方法：`
  - **加入`synchronized`**(太重了,效率低)
  - **使用JUC下的`AtomicInteger`**(这些类的底层都直接和操作系统挂钩！在内存中修改值！`Unsafe类`是一个很特殊的存在)

```java
public class Volatile {
  public static void main(String[] args) {
    atomicByVolatile();//验证volatile不保证原子性
  }
  public static void atomicByVolatile(){
    Test test= new Test();
    for(int i = 1; i <= 20; i++){
      new Thread(() ->{
        for(int j = 1; j <= 1000; j++){
          test.addSelf();
          test.atomicAddSelf();
        }
      },"Thread "+i).start();
    }
    while (Thread.activeCount()>2){
      Thread.yield();
    }
    System.out.println(Thread.currentThread().getName()+"\t finally num value is "+test.n);
    System.out.println(Thread.currentThread().getName()+"\t finally atomicnum value is "+test.atomicInteger);
  }
}
class Test  {
  volatile int n = 0;
  public void addSelf(){
    n++;
  }
  AtomicInteger atomicInteger = new AtomicInteger();//默认值为0
  public void atomicAddSelf(){
    atomicInteger.getAndIncrement();
  }
}
//打印结果：
/**
// 保证原子性的化  应该是 输出值 应该是 2万,  但是发现 输出值 是不对的, 
// 多线程下, 不保证原子性, 有加塞的情况,  存在覆盖写的问题
	main	 finally num value is 18864			**不保证原子性**  

	main	 finally atomicnum value is 20000	**保证原子性**
*/

```

![](https://youpaiyun.zongqilive.cn/image/20200421163331.png)



###  禁止指令重排

- `指令重排：` 多线程环境中线程交替执行，由于编译器优化重排的存在，两个线程中使用的变量能否保证一致性是无法确定的，结果无法预测。
- `指令重排过程：` 源代码 -> 编辑器优化的重排 -> 指令并行的重排 -> 内存系统的重排 ->最终执行的指令
- `内存屏障作用:`

1. 保证特定操作的执行顺序
2. 保证某些变量的内存可见性（利用该特性实现volatile的内存可见性）

![](https://youpaiyun.zongqilive.cn/image/20200421163648.png)

![](https://youpaiyun.zongqilive.cn/image/20200421164429.png)



![](https://youpaiyun.zongqilive.cn/image/20200421164223.png)

![](https://youpaiyun.zongqilive.cn/image/20200421164507.png)



**`Volatile` 是可以保持 可见性。不能保证原子性，由于内存屏障，可以保证避免指令重排的现象产生！** 































