## 哪些可以做GCRoots对象

GC Roots根节点:线程栈的本地变量、静态变量、本地方法栈的变量等等

在Java语言中,可作为GC Roots的对象包括下面几种:

- **虚拟机栈（栈帧中的局部变量区，也叫做局部变量表）中引用的对象**
- **方法区中的类静态属性引用的对象**
- **方法区中常量引用的对象**
- **本地方法栈中JNI（Native方法）引用的对象**(像多线程的 `start()` 方法)

![](https://youpaiyun.zongqilive.cn/image/20200603172530.png)
![](https://youpaiyun.zongqilive.cn/image/20200603172703.png)


![](https://youpaiyun.zongqilive.cn/image/20200423190625.png)

## 注意
![](https://youpaiyun.zongqilive.cn/image/20200603185406.png)

