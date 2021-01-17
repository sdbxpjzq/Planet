![](https://youpaiyun.zongqilive.cn/image/20210115104019.png)

```java
class A {
    public static void main(String[] args) {
      long maxMemory = Runtime.getRuntime().maxMemory() ;//返回 Java 虚拟机试图使用的最大内存量。
      long totalMemory = Runtime.getRuntime().totalMemory() ;//返回 Java 虚拟机中的内存总量。
      System.out.println("-Xmx:MAX_MEMORY = " + maxMemory + "（字节）、" + (maxMemory / (double)1024 / 1024) + "MB");
      System.out.println("-Xms:TOTAL_MEMORY = " + totalMemory + "（字节）、" + (totalMemory / (double)1024 / 1024) + "MB");
    
    }
}
```



- `-Xms` 等价于 `-XX: InitialHeapSize`, 初始堆大小, 默认物理内存的 1/64
- `-Xmx` 等价于` -XX: MaxHeapSize`, 最大堆大小, 默认为物理内存的 1/4.

但是开发过程中，通常会将 ==-Xms 与 -Xmx两个参数的配置相同的值==， 原因是避免内存忽高忽低产生停顿, 为了能够在java垃圾回收机制清理完堆区后, 不需要重新分隔计算堆区大小, 从而提高性能.

```
-Xms1024m -Xmx1024m -XX:+PrintGCDetails
```



- `-Xss` 设置越小，说明一个线程栈里能分配的栈帧就越少，但是对JVM整体来说能开启的线程数会更多

- `-Xmn`，这个参数可以调新生区和养老区的比例。但是，这个参数一般不调。





2、堆内存的内部配置

-XX:NewSize=n:设置新生代大小，如-XX:NewSize=1g表示新生代内存为1G。

-XX:NewRatio=n:设置新生代和年老生代的比值。如:为3，表示新生代与老生代比值为1：3，新生代占整个新生代年老生代的1/4

-XX:SurvivorRatio=n:新生代中Eden区与两个Survivor区的比值。注意Survivor区有两个。如：3，表示Eden：Survivor=3：2，一个Survivor区占整个新生代代的1/5。





**设置方法区内存大小**

-XX:PermSize:设置方法区初始内存分配大小。

-XX:MaxPermSize:设置方法区最大内存分配大小。





**对象存储配置**

-XX:PetenureSizeThreshold，多大的对象直接进入老年代，-XX:PetenureSizeThreshold=1000000，大小为1M的对象为大对象。

-XX:TargetSurvivorRatio:设置survivior 的使用率。当达到这个空间使用率时，会将对象送入老年代。XX:TargetSurvivorRatio=90，90表示让新生代的from区的利用率为90%，这样新对象进来就会优先在里面

-XX:MaxTenuringThreshold=n

表示在新生代经过n次回收以后还存活的对象移到老年代，默认值是15，设置31的目的是让对象尽可能的在新生代就被回收，避免进入老年代触发full GC。



![](https://youpaiyun.zongqilive.cn/image/20210115163236.png)

默认新生区占整个堆的`1/3`，养老区占`2/3`。

默认新生区又分为3份：伊甸园区：幸存者0区(from区):幸存者1区(to区) = `8:1:1`, 
但是有个自适应的 参数设置 `UseAdaptiveSizePolicy`



## NewRatio - 配置老年代占比

默认`-XX:NewRatio=2`, 表示新生代占1, 老年代占2, 新生代占整个对的1/3

## SurvivorRation

Eden空间和另外2个Survivor空间默认比例试`8:1:1`.
可以通过这个选项`-XX:SurvivorRation`调整比例







**二、参数设置：**

1. 配置年轻代与老年代在堆结构中的占比

2. - 默认 -XX:NewRatio=2，表示年轻代占比为1，老年代占比为2，那么年轻代就占整个堆空间的 1/3
   - 可以修改 -XX:NewRatio=4，表示年轻代占比为1，老年代占比为4，那么年轻代就占整个堆空间的 1/5

3. 在HotSpot中，年轻代中的Eden空间、Survivor0空间和Survivor1空间所占比例是8:1:1。但是实际是6:1:1

4. 通过配置 -XX:SurvivorRatio 可以调整年轻代中的Eden空间、Survivor0空间和Survivor1空间的比例。比如-XX:SurvivorRatio=8

5. 几乎所有的Java对象都是在Eden区被New出来的

6. 绝大多数Java对象的销毁都在新生代进行了

7. 可以选择 -Xmn 来设置新生代内存的大小。不过一般不用这个，一般会使用 -XX:NewRatio。

8. 参数设置总结：

9. - -XX:NewRatio ：设置新生代与老年代的比例。默认值是 2
   - -XX:SurvivorRatio：设置新生代中Eden和Survivor的比例
   - -XX:-UseAdaptiveSizePolicy：关闭自适应的内存分配策略（暂时用不到）
   - -Xmn：设置新生代的空间大小（一般不使用）



## JVM内存参数大小该如何设置



























