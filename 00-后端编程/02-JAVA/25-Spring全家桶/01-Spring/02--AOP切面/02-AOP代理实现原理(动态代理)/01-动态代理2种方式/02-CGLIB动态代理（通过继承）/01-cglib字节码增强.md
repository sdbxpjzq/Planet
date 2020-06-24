支持:  (接口 + 实现类)或 (只有实现类)   两种模式

## cglib 创建某个类A的动态代理类的模式是：

1.查找A上的所有`非final` 的`public`类型的方法定义；
 2.将这些方法的定义转换成字节码；
 3.将组成的字节码转换成相应的代理的class对象；
 4.实现 `MethodInterceptor`接口，用来处理对代理类上所有方法的请求（这个接口和JDK动态代理InvocationHandler的功能和角色是一样的）










## 代码示例



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

    // 不再接口种的方法
    public void doOther() {
        System.out.println("执行doOther");
    }
}
```

## `MethodInterceptor`接口实现

```java
import org.springframework.cglib.proxy.MethodInterceptor;
import org.springframework.cglib.proxy.MethodProxy;

import java.lang.reflect.Method;

public class MethodInterceptorImpl implements MethodInterceptor {
  @Override
  public Object intercept(Object o, Method method, Object[] objects, MethodProxy methodProxy) throws Throwable {
    System.out.println("method执行之前--执行");

    Object invoke = methodProxy.invokeSuper(o, objects);
    System.out.println("method执行结束之后--执行");

    return invoke;
  }
}
```

## `Enhancer`创建代理对象

```java
public class main {
  public static void main(String[] args) {
    // cglib 动态代理
    // 目标对象 -被代理的具体类
    SomeServiceImpl target = new SomeServiceImpl();

    MethodInterceptor methodInterceptor = new MethodInterceptorImpl();

    //cglib 中加强器，用来创建动态代理
    Enhancer enhancer = new Enhancer();
    //设置要创建动态代理的类
    enhancer.setSuperclass(target.getClass());
    // 设置回调，这里相当于是对于代理类上所有方法的调用，都会调用CallBack，而Callback则需要实行intercept()方法进行拦截
    enhancer.setCallback(methodInterceptor);

    SomeServiceImpl showService = (SomeServiceImpl) enhancer.create();
    // 接口种的方法
    showService.doSome();
    //实现类 独有的 方法
    showService.doOther();
  }
}


/*
输出:

method执行之前--执行
执行doSome
method执行结束之后--执行


method执行之前--执行
执行doOther
method执行结束之后--执行

*/
```

