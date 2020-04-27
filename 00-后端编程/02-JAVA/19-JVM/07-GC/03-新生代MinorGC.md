新生代使用的MinorGC，这种GC算法采用的是`复制算法（Copying）`，频繁使用

## **MinorGC的过程（复制 --> 清空 --> 互换）**

### **1-复制：** (Eden、SurvivorFrom 复制到 SurvivorTo，年龄+1）

当Eden区触发GC的时候会扫描Eden区域和From区域，对这两个区域进行垃圾回收，经过这次回收后还存活的对象，则直接复制到To区域（如果有对象的年龄已经到达了老年的标准，则复制到老年代区），同时把这些对象的年龄加1。

### **2-空：**(清空Eden、SurvivorFrom）

清空Eden和SurvivorFrom中的对象，也即复制之后有交换，谁空谁是to。

### **3-互换：**(SurvivorTo和SurvivorFrom 互换)

最后，SurvivorTo和SurvivorFrom 互换，原SurvivorTo成为下一次GC是的SurvivorFrom区。

部分对象会在From和To区域中复制来复制去, 如此交换15次(最大15次,由JVM参数`-XX：MaxTenuringThreshold`决定, 默认是15), 最终如果还是存活, 就存入老年代.

 

![img](https://youpaiyun.zongqilive.cn/image/20200318151630.png)





![](https://youpaiyun.zongqilive.cn/image/20200318144424.png)



## 注意点

- GC发生在伊甸园区，当对象快占满新生代时，就会发生YGC（Young GC，轻量级GC）操作，伊甸园区基本全部清空
- 幸存者0区(S0)，别名“from区”。伊甸园区没有被YGC清空的对象将移至幸存者0区，幸存者1区别名“to 区”
- 每次进行YGC操作，幸存的对象就会从伊甸园区移到幸存者0区，如果幸存者0区满了，就会继续往下移，如果经历数次YGC操作对象还没有消亡，最终会来到养老区
- 如果到最后，养老区也满了，那么就对养老区进行FGC(Full GC，重GC)，对养老区进行清洗
- 如果进行了多次FGC之后，还是无法腾出养老区的空间，就会报**OOM（out of Memory）**异常
- **from区和to区位置和名分不是固定的，每次GC过后都会交换，GC交换后，谁空谁是to区**

