![](https://youpaiyun.zongqilive.cn/image/20200319102429.png)

![](https://youpaiyun.zongqilive.cn/image/20200427084955.png)



![img](https://youpaiyun.zongqilive.cn/image/39350216.png)

上面图中是`亮色`的地方有两个特点：

- **所有线程共享**（**灰色是线程私有**）
- **`亮色`地方存在垃圾回收**

>  我们平时说的栈是指的`Java栈`，`native method stack` 里面装的都是`native方法`



`虚拟机栈：`虚拟机栈中执行每个方法的时候，都会创建一个栈帧用于存储局部变量表，操作数栈，动态链接，方法出口等信息。

`本地方法栈：`与虚拟机栈发挥的作用相似，相比于虚拟机栈为Java方法服务，本地方法栈为虚拟机使用的Native方法服务，执行每个本地方法的时候，都会创建一个栈帧用于存储局部变量表，操作数栈，动态链接，方法出口等信息。

`方法区：`它用于存储已被虚拟机加载的**类信息，常量，静态变量**，即时编译器编译后的代码等数据，**方法区在JDK1.7版本及之前称为永久代，从JDK1.8之后永久代被移除。**

`堆：`堆是Java对象的存储区域，任何new字段分配的**Java对象实例和数组**，都被分配在了堆上，Java堆可使用 - **Xms** / - **Xmx** 进行内存控制，从JDK1.7版本之后，**运行时常量池**从方法区移到了堆上。

`程序计数器：`指示Java虚拟机下一条需要执行的字节码指令。



![](https://youpaiyun.zongqilive.cn/image/20200709190738.png)





## JVM架构模型

![](https://youpaiyun.zongqilive.cn/image/20200319102602.png)

栈式架构:  指令小, 指令集多

寄存器架构:  指令多

![](https://youpaiyun.zongqilive.cn/image/20200319102654.png)

![](https://youpaiyun.zongqilive.cn/image/20200319103116.png)











