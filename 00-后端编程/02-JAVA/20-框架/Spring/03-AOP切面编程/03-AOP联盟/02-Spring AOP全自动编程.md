## 导入jar包

aspectjweaver.jar



## 目标类

> 注意都在 service 这包下边, 方便XML的配置

```java
package zongqi.demo_06.service;

public interface IUser {
    public int delUser(int id);
    public int addUser();
}


package zongqi.demo_06.service;

public class UserServiceImpl implements IUser {
    public int delUser(int id) {
        System.out.println("删除用户ID" + id);
        return 100;
    }

    public int addUser() {
        System.out.println("增加用户");
        return 10;
    }
}
```

## 切面类

```java
import org.aopalliance.intercept.MethodInterceptor;
import org.aopalliance.intercept.MethodInvocation;

// 切面类
public class MyAspect implements MethodInterceptor {
    @Override
    public Object invoke(MethodInvocation invocation) throws Throwable {
        // 拦截方法
        System.out.println("开启事务");

        Object ret = invocation.proceed();

        System.out.println("提交事务");
        return ret;
    }
}
```

## AOP配置

![](https://pic.superbed.cn/item/5db0ffbf8b58bc7bf7dac834.jpg)



```xml
<!--    业务类-->
    <bean id="userService_05" class="zongqi.demo_05.service.UserServiceImpl"></bean>
    <!--    代理类-->
    <bean id="myAspectDemo_05" class="zongqi.demo_05.aspect.MyAspect"></bean>

    <!--    全自动导入-->
    <aop:config proxy-target-class="true">
        <aop:pointcut id="pointcut" expression="execution(* zongqi.demo_05.service.*.*(..))"></aop:pointcut>
        <aop:advisor advice-ref="myAspectDemo_05" pointcut-ref="pointcut"></aop:advisor>
    </aop:config>
```

## 测试类

```java
public void test() {
        ApplicationContext context = new ClassPathXmlApplicationContext("applicationContext.xml");
        IUser userService = (IUser) context.getBean("userService_05");
        userService.addUser();

    }
```

