## 强引用

![](https://youpaiyun.zongqilive.cn/image/20200605162526.png)



![](https://youpaiyun.zongqilive.cn/image/20200605162633.png)



- 当内存不足，JVM开始垃圾回收，对于强引用的对象，**就算出现了OOM也不会对该对象进行回收，死都不收**
- 强引用是我们最常见的普通对象引用，只要还有强引用指向一个对象，就能表名对象还“活着”，垃圾收集器不会碰这种对象。在Java中最常见的就是强引用，把一个对象赋给一个引用变量，这个引用变量就是一个强引用。当一个对象被强引用变量引用时，它处于可达状态，它是不可能被垃圾回收机制回收的。**即使该对象以后永远都不会被用到，JVM也不会回收。** **因此强引用是造成Java内存泄漏的主要原因之一。**
- 对于一个普通的对象，如果没有其他的引用关系，只要超过了引用的作用域或者显式地将相应（强）引用赋值为**null**，一般就是认为可以被垃圾收集（具体看垃圾收集策略）

![](https://youpaiyun.zongqilive.cn/image/20200425134342.png)

代码:

![](https://youpaiyun.zongqilive.cn/image/20200425134725.png)



