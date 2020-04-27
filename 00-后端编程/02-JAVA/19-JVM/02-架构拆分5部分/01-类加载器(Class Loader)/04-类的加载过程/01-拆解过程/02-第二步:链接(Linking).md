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

















































