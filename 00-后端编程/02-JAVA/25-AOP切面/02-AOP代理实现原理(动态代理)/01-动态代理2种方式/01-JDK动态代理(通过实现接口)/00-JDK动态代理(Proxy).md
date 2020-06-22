支持: ( 接口 + 实现类 ) 模式,==必须有实现的接口==

## 步骤

1. 创建目标类
2. 创建`InvocationHandler`接口的实现类
3. 使用JDK中的`Proxy`类, 创建代理对象



## 代码实现

### 目标类

`SomeService`接口

```java
public interface SomeService {
    void doSome();
}
```

`SomeServiceImpl`实现类

```java
public class SomeServiceImpl implements SomeService {
    @Override
    public void doSome() {
        System.out.println("执行doSome");
    }
}
```



### `InvocationHandler`接口实现类

```java
import java.lang.reflect.InvocationHandler;
import java.lang.reflect.Method;

public class InvocationHandleImpl implements InvocationHandler {


    /**
     * 目标对象
     */
    private Object target;

    public InvocationHandleImpl(Object target) {
        this.target = target;
    }

    @Override
    public Object invoke(Object proxy, Method method, Object[] args) throws Throwable {
        // 通过代理对象执行方法时,会调用执行这个invoke()

        System.out.println("method执行之前--执行");

        Object result;
        result = method.invoke(target, args);

        System.out.println("method执行结束之后--执行");

        return result;
    }
}
```



## `Proxy`创建代理对象

```java
import java.lang.reflect.Proxy;

public class main {
    public static void main(String[] args) {
        // JDK 动态代理
        // 目标对象 -被代理的具体类
        SomeServiceImpl target = new SomeServiceImpl();

        // 创建InvocationHandle对象
        InvocationHandleImpl invocationHandleImpl = new InvocationHandleImpl(target);

        // 使用Proxy创建代理对象
        Object proxy = Proxy.newProxyInstance(
                target.getClass().getClassLoader(),
                target.getClass().getInterfaces(),
                invocationHandleImpl);
        SomeService someService = (SomeService) proxy;
        someService.doSome();
        generateClassFile(target.getClass(), proxy.getClass().getName());

    }
}
```

