- 初始化: 对类的`静态变量`初始化为指定的值，执行静态代码块

![](https://youpaiyun.zongqilive.cn/image/20200319111803.png)

注意：

- `<clinit>()`并不是类的构造方法，构造方法在编译后是`<init>()`方法
- 如果类有父类，则子类的`<clinit>()`一定晚于父类的`<clinit>()`方法执行（必须保证父类已初始化完毕）
- `<clinit>()`方法不需要定义，编译器自动收集类中的所有类变量的赋值动作和静态代码块中的语句合并而来。
- `<clinit>()`方法内的执行逻辑是按照源代码的顺序而来
- `<clinit>()`方法针对的是`静态变量`，静态变量在链接过程中全部赋值为初始值，在初始化阶段才真正的赋初值。

![](https://youpaiyun.zongqilive.cn/image/20200319113203.png)



![](https://youpaiyun.zongqilive.cn/image/20200319113357.png)



## 初始化问题演示

初始化过程只在第一次主动使用类的时候才发生，主动使用类情况如下：

- 创建类的实例（new）
- 初始化该类的子类
- 调用某个类的静态方法
- 访问某个类或者接口的静态属性，或对静态属性赋值
- 使用反射机制获取类的Class对象,比如`Class.forName("com.mysql.jdbc.Driver"）`
- Java虚拟器标明为启动类的类
- JDK7以后使用动态语言机制解析的类
- 

除上述情况外，都属于类的被动使用，不会对类进行初始化.

**初始化代码只会被执行一次，即使是多线程环境下，编译器会自动为初始化代码进行加锁处理**


```java
public class ClassInitTest {
  public static void main(String[] args) {
    Runnable r = ()->{
      System.out.println("线程"+Thread.currentThread().getName()+"开始执行！");
      new A();
    };
    Thread t1 =new Thread(r,"t1");
    Thread t2 =new Thread(r,"t2");
    t1.start();
    t2.start();
  }
}

class A
{
  static {
    System.out.println("类A被"+Thread.currentThread().getName()+"初始化！");
  }
}
//结果
// 线程t1开始执行！
// 线程t2开始执行！
// 类A被t1初始化！
```

上述演示说明:  t1线程进行初始化操作，t2线程也准备对A进行初始化操作，但是由于线程锁的存在，t2线程此时无法访问初始化代码，这保证了初始化操作只能被执行一次！



























































