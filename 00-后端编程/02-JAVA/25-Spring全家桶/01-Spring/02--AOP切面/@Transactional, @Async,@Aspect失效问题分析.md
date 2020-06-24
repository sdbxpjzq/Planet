## AOP 注解失效的原因与解决方法

https://www.asundae.com/archives/35-answer.html



```java
@Controller
public class TestController {
    @RequestMapping(path = "/index", method = RequestMethod.GET)
    public String index(){
        test();
        return "login";
    }
    
    @Time            //在此加了自定义注释
    public void test() throws Exception {
        System.out.println("test");
    }
}
```



发现在这样一个例子中 test 方法上的 @Time 注解始终处于无效状态 (但是如果将注解标注在 @RequestMapping 的方法上就可以正常通过 Aspect 拦截)，查看编译后的代码，注解仍然存在，没有问题。



==使用 **JDK 的 Proxy** 或者 **CGLib**，由于进行了动态代理，这时在启动完成运行的状态下 class 已经不再是原先的 class 了，而是使用了被代理的 class。==



## 例子

- 类 X 的对象  ----直接调用其中----> 带注解的 A 方法

  此注解是有效的, 因为此时，Spring 会判断你将要调用的方法上存在 AOP 注解，那么会==使用类 X 的代理对象调用 A 方法==。



- 类 X 的对象  ----直接调用其中----> A 方法 ----A 方法调用----> 带注解的 B 方法(B 方法上的注解是无效的)

  因为此时 Spring 判断你调用的 A 无注解，所以使用的还是原对象而非代理对象。接下来 A 再调用 B 时，在原对象内 B 方法的注解当然无效了。



==**简而言之：就是如果在一个类中通过 A 方法调用带注解的 B 方法就会失败，因为这时使用的是原来的类实例，而不是代理过后的类实例，所以 Aspect 不会生效。**==





## 解决方法

1. 使用 `@Autowired` 注解自动装填当前对象，这时获取的是当前对象的代理对象。

   ```java
   @Autowired
   private TestController testController;
   
   testController.test();
   ```

2. Spring 提供了一个自动获取当前对象的代理对象的工具方法 `AopContext.currentProxy()`

   ```java
   ((TestController)AopContext.currentProxy()).test();
   ```

   



























