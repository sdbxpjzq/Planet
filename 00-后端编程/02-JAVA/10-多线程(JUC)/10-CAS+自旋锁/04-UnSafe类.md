## 何为UnSafe

`UnSafe`是CAS的`核心类`，由于Java方法无法直接访问底层，需要通过本地（native）方法来访问，UnSafe相当于一个后门，基于该类可以直接操作额定的内存数据。提供了硬件级别的原子操作



`UnSafe`类在于`sun.misc`包中。其中内部方法可以向C的指针一样直接操作内存，因为Java中CAS操作的执行依赖于`UnSafe`类的方法

变量 **ValueOffset** ， 便是该变量在内存中偏移地址，因为UnSafe就是根据内存偏移地址来获取数据的。

```java
public final int getAndIncrement() {
  return unsafe.getAndAddInt(this, valueOffset, 1);
}
```

变量 `value` 用` volatile `修饰，保证了多线程之间的可见性。



![](https://youpaiyun.zongqilive.cn/image/20200421173921.png)



