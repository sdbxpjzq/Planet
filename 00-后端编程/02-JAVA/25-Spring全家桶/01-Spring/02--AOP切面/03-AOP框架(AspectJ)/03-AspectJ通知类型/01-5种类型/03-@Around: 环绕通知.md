

```java
@Aspect
public class MyAspect {
    /**
     * 环绕通知方法的定义格式
     *  1.public
     *  2.必须有一个返回值，推荐使用Object
     *  3.方法名称自定义
     *  4.方法有参数，固定的参数 ProceedingJoinPoint
     */

    /**
     * @Around: 环绕通知
     *    属性：value 切入点表达式
     *    位置：在方法的定义什么
     * 特点：
     *   1.它是功能最强的通知
     *   2.在目标方法的前和后都能增强功能。
     *   3.控制目标方法是否被调用执行
     *   4.修改原来的目标方法的执行结果。 影响最后的调用结果
     *
     *  环绕通知，等同于jdk动态代理的，InvocationHandler接口
     *
     *  参数：  ProceedingJoinPoint 就等同于 Method
     *         作用：执行目标方法的
     *  返回值： 就是目标方法的执行结果，可以被修改。
     *
     *  环绕通知： 经常做事务， 在目标方法之前开启事务，执行目标方法， 在目标方法之后提交事务
     */
    @Around(value = "execution(* *..SomeServiceImpl.doFirst(..))")
    public Object myAround(ProceedingJoinPoint pjp) throws Throwable {

        String name = "";
        //获取第一个参数值
        Object args [] = pjp.getArgs();
        if( args!= null && args.length > 1){
              Object arg=  args[0];
              name =(String)arg;
        }

        //实现环绕通知
        Object result = null;
        System.out.println("环绕通知：在目标方法之前，输出时间："+ new Date());
        //1.目标方法调用
        if( "zhangsan".equals(name)){
            //符合条件，调用目标方法
            result = pjp.proceed(); //method.invoke(); Object result = doFirst();

        }

        System.out.println("环绕通知：在目标方法之后，提交事务");
        //2.在目标方法的前或者后加入功能

        //修改目标方法的执行结果， 影响方法最后的调用结果
        if( result != null){
              result = "Hello AspectJ AOP";
        }

        //返回目标方法的执行结果
        return result;
    }
}
```



```java
public class MyTest03 {

    @Test
    public void test01(){
        String config="applicationContext.xml";
        ApplicationContext ctx = new ClassPathXmlApplicationContext(config);
        //从容器中获取目标对象
        SomeService proxy = (SomeService) ctx.getBean("someService");


        //通过代理的对象执行方法，实现目标方法执行时，增强了功能
        String str = proxy.doFirst("zhangsan",20); /// 相当于执行myAround(), 一定是可以修改结果值的

        //String str = proxy.doFirst() {  return myAround(); }
        //String str = proxy.myAround("zhangsan",20);
        
        //System.out.println("str===="+str);

    }
}
```

