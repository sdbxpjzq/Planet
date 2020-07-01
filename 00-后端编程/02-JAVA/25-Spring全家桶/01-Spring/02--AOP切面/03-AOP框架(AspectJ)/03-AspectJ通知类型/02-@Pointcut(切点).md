## Pointcut：切点

![](https://youpaiyun.zongqilive.cn/image/20200626090658.png)

```java
@Aspect
public class MyAspect {


    @After(value = "mypt()")
    public  void  myAfter(){
        System.out.println("执行最终通知，总是会被执行的代码");
        //一般做资源清除工作的。
     }

    @Before(value = "mypt()")
    public  void  myBefore(){
        System.out.println("前置通知，在目标方法之前先执行的");
    }

    /**
     * @Pointcut: 定义和管理切入点， 如果你的项目中有多个切入点表达式是重复的，可以复用的。
     *            可以使用@Pointcut
     *    属性：value 切入点表达式
     *    位置：在自定义的方法上面
     * 特点：
     *   当使用@Pointcut定义在一个方法的上面 ，此时这个方法的名称就是切入点表达式的别名。
     *   其它的通知中，value属性就可以使用这个方法名称，代替切入点表达式了
     */
    @Pointcut(value = "execution(* *..SomeServiceImpl.doThird(..))" )
    private void mypt(){
        //无需代码，
    }

}
```





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

