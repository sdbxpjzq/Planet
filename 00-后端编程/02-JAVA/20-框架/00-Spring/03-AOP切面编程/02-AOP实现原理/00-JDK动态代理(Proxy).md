支持: ( 接口 + 实现类 ) 模式



## 代码实现

### 目标类

```java
// 接口
public interface IUser {
    public int delUser(int id);
    public int addUser();
}

// 实现类
public class UserServiceImpl implements IUser {

    @Override
    public int addUser() {
        System.out.println("添加用户");
        return 10;
    }

    @Override
    public int delUser(int id) {
        System.out.println("通过ID删除用户" + id);
        return id;
    }
}
```

### 切面类

```java
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
    public static IUser createUserService() {
        //1 创建目标对象
        UserServiceImpl userService = new UserServiceImpl();
        //2 创建撇面类
        MyAspect myAspect = new MyAspect();

        //3 把切面类的2方法 应用到目标类

        // 3.1 创建jdk代理
        /*
        ClassLoader loader, 类加载器, 写当前类
        Class<?>[] interfaces, 接口
        InvocationHandler h // 处理
        */

        IUser userServiceProxy = (IUser) Proxy.newProxyInstance(
                MyBeanFactory.class.getClassLoader(),
                userService.getClass().getInterfaces(),
                new InvocationHandler() {
                    @Override
                    public Object invoke(Object proxy, Method method, Object[] args) throws Throwable {
                        // 开启事务
                        myAspect.before();

                        Object ret = method.invoke(userService, args);
//                        System.out.println("拦截返回值" + ret);

                        // 提交事务
                        myAspect.after();

                        // 返回值是业务方法的返回值
                        return ret;
                    }
                }
        );
        // 返回代理
        return userServiceProxy;
    }
}
```

### 测试类

```java
public void test1() {
        IUser userService = MyBeanFactory.createUserService();
        int num = userService.delUser(100);
        userService.addUser();

    }
```

