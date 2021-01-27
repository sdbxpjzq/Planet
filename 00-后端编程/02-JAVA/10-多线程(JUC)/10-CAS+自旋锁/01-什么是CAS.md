## 什么是CAS

- CAS 全称 => `Compare-And-Set` ,是一个CPU原子指令

- CAS是一条原子指令，不会造成所谓的数据不一致的问题

- 三个操作数: `内存值V`, `预期值A`, `要修改的值B`,  当预期值A == 内存值V 时, 才将内存值修改为B, 否则什么都不做, 返回现在的 内存值V

CAS并发源语体现在Java语言中就是sun.miscUnSafe类中的各个方法，调用UnSafe类中的CAS方法，JVM会帮我实现CAS汇编指令，这是一种完全依赖于`硬件`功能，通过它实现了原子操作，再次强调，由于CAS是一种系统源语，

![](https://youpaiyun.zongqilive.cn/image/20200307172419.png)



```java

public class CASDemo{
	public static void main(String[] args) {
    // 默认是0
        AtomicInteger atomicInteger = new AtomicInteger();
        System.out.println(atomicInteger.compareAndSet(0,5));       //true
        System.out.println(atomicInteger.compareAndSet(0,2));       //false
        System.out.println(atomicInteger);                          //5
    }
}
 // 主内存值是0 , main线程去修

```



































































































