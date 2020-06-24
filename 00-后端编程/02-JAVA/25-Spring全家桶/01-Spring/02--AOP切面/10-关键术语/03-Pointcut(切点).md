## Pointcut：切点

用来匹配特定接入点的谓词（表达式），增强将会与切点表达式产生关联，并运行在任何切点匹配到的接入点上。

通过切点表达式匹配接入点是AOP的核心，Spring默认使用AspectJ的切点表达式。



命名切点的结构如下:

![](https://youpaiyun.zongqilive.cn/image/20200613092033.png)



`切点可访问性修饰符`与`类可访问性修饰符`的功能是相同的，它可以决定定义的切点可以在哪些类中可使用。

因为命名切点仅利用**方法名**及**访问修饰符**的信息，所以我们一般定义方法的返回类型为 void ，并且方法体为空 。

```java
public class NamePointcut {

    /**
     * 切点被命名为 method2，且该切点可以在本类或子孙类中使用
     */
    @Pointcut("within(net.deniro.spring4.aspectj.*)")
    protected void method2() {
    }
}

```

