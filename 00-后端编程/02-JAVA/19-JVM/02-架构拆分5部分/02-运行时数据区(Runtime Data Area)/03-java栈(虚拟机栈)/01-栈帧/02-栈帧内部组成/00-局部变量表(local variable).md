

- 局部变量表（Local Variable Table）主要用于存储**方法参数**和方法内部定义的**局部变量**，包含了编译器可知的基本数据类型（byte，short，int，long，double，float，char，boolean），对象引用（reference）以及returnAddress类型。
- 由于局部变量表是简历在线程的栈上, 是线程私有的数据, 因此不存在数据安全问题
- 局部变量表所需的容量大小是在编译期确定下来的, 并保存在方法的Code属性的 `maximum local variables`数据项中, ==在方法运行期间是不会改变容量大小的==







![](https://youpaiyun.zongqilive.cn/image/20200319174607.png)



- 方法嵌套调用的次数由栈的大小决定, 一般来说,栈越大, 方法嵌套调用次数越多. 对一个函数而言, 它的参数和局部变量越多, 使的局部变量表膨胀, 它的栈帧就越大,  以满足方法调用所需传递的信息增大的需求, 进而函数调用就会占用更多的栈空间, 导致其嵌套调用次数 减少.
- 局部变量表中的变量只在当前方法调用中有效, 在方法执行时, 虚拟机通过使用局部变量表完成参数值到参数变量列表的传递过程, 当方法调用结束后, 随着方法栈帧的销毁, 局部变量表也会随之销毁.
- 



![](https://youpaiyun.zongqilive.cn/image/20200319174716.png)

## 字节码中方法内部结构的剖析

![](https://youpaiyun.zongqilive.cn/image/20200319180221.png)

![](https://youpaiyun.zongqilive.cn/image/20200319182225.png)



## 变量槽slot的理解与演示

![](https://youpaiyun.zongqilive.cn/image/20200319182240.png)

![](https://youpaiyun.zongqilive.cn/image/20200319182334.png)

![](https://youpaiyun.zongqilive.cn/image/20200319182356.png)

![](https://youpaiyun.zongqilive.cn/image/20200319182406.png)

![](https://youpaiyun.zongqilive.cn/image/20200319182417.png)

![](https://youpaiyun.zongqilive.cn/image/20200319182430.png)

## 静态变量与局部变量的对比及小结

![](https://youpaiyun.zongqilive.cn/image/20200319182449.png)

![](https://youpaiyun.zongqilive.cn/image/20200319182500.png)



