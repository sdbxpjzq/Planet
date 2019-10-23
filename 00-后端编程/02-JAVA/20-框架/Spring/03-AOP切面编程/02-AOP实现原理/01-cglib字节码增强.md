支持:  (接口 + 实现类)或 (只有实现类)   两种模式



## 代码示例



### 目标类

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

### 切面类

```java
// 切面类
public class MyAspect {

    public void before() {
        System.out.println("开启事务");
    }

    public void after() {
        System.out.println("提交事务");
    }
}

```

### 工厂类

```java
public class MyBeanFactory {
    public static UserServiceImpl createUserService() {
        // 1. 目标对象
        IUser userService = new UserServiceImpl();
        // 2. 创建切面
        MyAspect myAspect = new MyAspect();

        // 创建增强对象
        Enhancer enhancer = new Enhancer();
        // 设置父类
        enhancer.setSuperclass(userService.getClass());
        // 设置回调[拦截]
        enhancer.setCallback(new MethodInterceptor() {
            @Override
            public Object intercept(Object o, Method method, Object[] objects, MethodProxy methodProxy) throws Throwable {
                // Object o 是代理类
                // Object[] objects 参数数组
                // methodProxy 代理类 方法

                myAspect.before();
//                System.out.println("拦截方法");

                // 执行目标类 方法
//                Object ret = method.invoke(userService, objects);

                // 执行代理类方法. (目标类 和 代理类是 父子关系). 等同于上边调用 [推荐这种写法]
                Object ret = methodProxy.invokeSuper(o, objects);
                myAspect.after();
                return ret;
            }
        });

        // 创建代理对象
        UserServiceImpl userServiceProxy = (UserServiceImpl) enhancer.create();

        return userServiceProxy;

    }
}
```

