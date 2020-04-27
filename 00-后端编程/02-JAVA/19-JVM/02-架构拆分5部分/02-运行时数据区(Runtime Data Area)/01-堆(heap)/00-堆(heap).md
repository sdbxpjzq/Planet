## java堆

Java 堆用来存放实例化对象，它被所有线程共享，在虚拟机启动时创建，用来存放对象实例，其占用了 Java 内存的大部分空间，是 GC 的主要管理区域，又可分为年轻代、老年代、永久代。

年轻代又可分为 Eden，from Survivor，to Survivor。Eden 区用来存放刚刚创建的对象，如果 Eden 区放不下，则放在 Survivor 区，甚至老年代中。Survivor 区又可分为 Survivor From 和 Survivor To，GC 回收时使用，将 Eden 中存活的对象存入 Survior From 中，下一次回收时，将 Survior From 中的对象存入 Survior To 中，清除 Survior From ，下一次回收时重复此步骤，Survior From 变成 Survior To，Survivor To 变成 Survivor From，依次循环，同时每次回收，对象的年龄都 +1，年龄增加到一定程度的对象，移动到老年代中。

老年代是存放生命周期较长的对象，而永久代在 JDK 8 之后已经被元空间替代。元空间使用本地内存，永久代使用 JVM 内存，所以使用元空间的好处在于程序的内存不再受限于 JVM 内存，本地内存剩余多少空间，元空间就可以有多大，解决了空间不足的问题。



![](https://youpaiyun.zongqilive.cn/image/20200318143732.png)



![](https://youpaiyun.zongqilive.cn/image/20200318143641.png)

说明:

- **Java 8**把**永久区**换成了**`元空间`**
- **堆逻辑上由”新生+养老+元空间“三个部分组成，物理上由”新生+养老“两个部分组成**
- 当执行`new Person()；`时，其实是new在新生区的伊甸园区，然后往下走，走到养老区，但是并未到元空间。

## 永久带和元空间

![](https://youpaiyun.zongqilive.cn/image/20200424094854.png)

这是一个常驻内存的区域, 用于存放JDK自身所携带的Class,Interface的元数据, 也就是说它存储的是运行环境必须的类信息, 被装载进此区域的数据是不会被垃圾回收器回收掉的, 关闭JVM才会释放此区域所占用的内存.

## 空间占比

整个堆分为`新生区`和`养老区`，

新生区占整个堆的`1/3`，养老区占`2/3`。

新生区又分为3份：伊甸园区：幸存者0区(from区):幸存者1区(to区) = `8:1:1`



























































































































