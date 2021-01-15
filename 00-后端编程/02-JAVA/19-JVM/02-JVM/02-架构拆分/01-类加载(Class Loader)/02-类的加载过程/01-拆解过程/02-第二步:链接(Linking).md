- 验证:  校验字节码文件的正确性 

- 准备: 给类的静态变量分配内存，并赋予默认值 
- 解析: 将符号引用替换为直接引用，该阶段会把一些静态方法(符号引用，比如main()方法)替换为指向数据所存内存的指针或句柄等(直接引用)，这是所谓的静态链 接过程(类加载期间完成)，动态链接是在程序运行期间完成的将符号引用替换为直接 引用，下节课会讲到动态链接

![](https://youpaiyun.zongqilive.cn/image/20200319111146.png)

> 只会将变量的值赋值为初始值(零值), 但如果以final修饰该变量，则链接阶段就会显示的初始化该常量的值







```java
public class HelloApp {
	private static int a=1:;//链接阶段只会将a赋值为0
	private static Date d = new Date();//连接阶段只会将d赋值为null
	public final int b = 5;//连接阶段会直接将常量值初始化为5
	public static void main(String[] args) {}
}
```

















































