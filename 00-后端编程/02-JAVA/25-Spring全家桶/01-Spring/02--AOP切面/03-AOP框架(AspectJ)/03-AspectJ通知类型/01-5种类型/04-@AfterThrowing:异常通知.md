

```java
@Aspect
public class MyAspect {
    /**
     * 异常通知方法的定义格式
     *  1.public
     *  2.没有返回值
     *  3.方法名称自定义
     *  4.方法有个一个Exception， 如果还有是JoinPoint,
     */

    /**
     * @AfterThrowing:异常通知
     *     属性：1. value 切入点表达式
     *          2. throwinng 自定义的变量，表示目标方法抛出的异常对象。
     *             变量名必须和方法的参数名一样
     * 特点：
     *   1. 在目标方法抛出异常时执行的
     *   2. 可以做异常的监控程序， 监控目标方法执行时是不是有异常。
     *      如果有异常，可以发送邮件，短信进行通知
     *
     *  执行就是：
     *   try{
     *       SomeServiceImpl.doSecond(..)
     *   }catch(Exception e){
     *       myAfterThrowing(e);
     *   }
     */
    @AfterThrowing(value = "execution(* *..SomeServiceImpl.doSecond(..))",
            throwing = "ex")
    public void myAfterThrowing(Exception ex) {
        System.out.println("异常通知：方法发生异常时，执行："+ex.getMessage());
        //发送邮件，短信，通知开发人员
    }

}
```

