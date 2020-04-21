## 什么是CAS

CAS 全称 => Compare-And-Set , **它是一条CPU并发源语**

他的功能就是判断内存某个位置的值是否为预期值，如果是则更新为新的值，这个过程是原子的。

CAS并发源语体现在Java语言中就是sun.miscUnSafe类中的各个方法，调用UnSafe类中的CAS方法，JVM会帮我实现CAS汇编指令，这是一种完全依赖于`硬件`功能，通过它实现了原子操作，再次强调，由于CAS是一种系统源语，源语属于操作系统用于范畴，是由若干个指令组成，用于完成某个功能的一个过程，并且源语的执行必须是连续的，在**执行过程中不允许中断，也即是说CAS是一条原子指令，不会造成所谓的数据不一致的问题**

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
 // 主内存值是0 , main线程去修改

```

## CAS原理

```java
public final int getAndIncrement() {
  return unsafe.getAndAddInt(this, valueOffset, 1);		//引出问题=》何为unsafe
}

```

## 何为UnSafe

![](https://youpaiyun.zongqilive.cn/image/20200421173921.png)



`UnSafe`是CAS的`核心类`，由于Java方法无法直接访问底层，需要通过本地（native）方法来访问，UnSafe相当于一个后门，基于该类可以直接操作额定的内存数据。

`UnSafe`类在于`sun.misc`包中。其中内部方法可以向C的指针一样直接操作内存，因为Java中CAS操作的执行依赖于`UnSafe`类的方法

变量 **ValueOffset** ， 便是该变量在内存中偏移地址，因为UnSafe就是根据内存偏移地址来获取数据的。

```java
public final int getAndIncrement() {
  return unsafe.getAndAddInt(this, valueOffset, 1);
}
```

变量 `value` 用` volatile `修饰，保证了多线程之间的可见性。









































































































