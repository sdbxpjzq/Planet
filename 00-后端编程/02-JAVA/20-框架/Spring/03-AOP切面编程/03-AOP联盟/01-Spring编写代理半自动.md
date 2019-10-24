## 导入jar包

【核心4+1 、AOP联盟（规范）、spring-aop （实现）】

## 目标类

```java
public interface IUser {
    public int delUser(int id);
    public int addUser();
}


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
![](https://pic.superbed.cn/item/5db0fcaa8b58bc7bf7da9d29.jpg)



## XML配置

![](https://pic.superbed.cn/item/5db0fcde8b58bc7bf7daa08f.jpg)

```xml
<!--    业务类-->
    <bean id="userServiceImpl" class="zongqi.demo_04.UserServiceImpl"></bean>
    <!--    代理类-->
    <bean id="myAspect" class="zongqi.demo_04.aspect.MyAspect"></bean>

    <!--代理类-->
    <bean id="proxyService" class="org.springframework.aop.framework.ProxyFactoryBean">
        <!--        <property name="interfaces" value="zongqi.demo_04.IUser">-->
        <property name="interfaces">
            <list>
                <value>zongqi.demo_04.IUser</value>
            </list>
        </property>
        <property name="target" ref="userServiceImpl"></property>
        <property name="interceptorNames" value="myAspect"></property>
    </bean>
```

## 测试

```java
public void test1() {
  // 获取Spring容器中的对象
  ClassPathXmlApplicationContext context = new ClassPathXmlApplicationContext("applicationContext.xml");
  IUser userService = (IUser) context.getBean("proxyService");
  userService.addUser();
}
```





