支持:  (接口 + 实现类)或 (只有实现类)   两种模式

字节码重组

## cglib 创建某个类A的动态代理类的模式是：

1.查找A上的所有`非final` 的`public`类型的方法定义；
 2.将这些方法的定义转换成字节码；
 3.将组成的字节码转换成相应的代理的class对象；
 4.实现 `MethodInterceptor`接口，用来处理对代理类上所有方法的请求（这个接口和JDK动态代理InvocationHandler的功能和角色是一样的）



```
//CGLib的动态代理是通过生成一个被代理对象的子类，然后重写父类的方法
//生成以后的对象，可以强制转换为被代理对象（也就是用自己写的类）
//子类引用赋值给父类
```






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







```java

import java.lang.reflect.Method;

import net.sf.cglib.proxy.Enhancer;
import net.sf.cglib.proxy.MethodInterceptor;
import net.sf.cglib.proxy.MethodProxy;

public class GPMeipo implements MethodInterceptor{

	//疑问？
	//好像并没有持有被代理对象的引用
	public Object getInstance(Class clazz) throws Exception{
		
		Enhancer enhancer = new Enhancer();
		//把父类设置为谁？
		//这一步就是告诉cglib，生成的子类需要继承哪个类
		enhancer.setSuperclass(clazz);
		//设置回调
		enhancer.setCallback(this);
		
		//第一步、生成源代码
		//第二步、编译成class文件
		//第三步、加载到JVM中，并返回被代理对象
		return enhancer.create();
	}
	
	//同样是做了字节码重组这样一件事情
	//对于使用API的用户来说，是无感知
	@Override
	public Object intercept(Object obj, Method method, Object[] args, MethodProxy proxy) throws Throwable {
		System.out.println("我是GP媒婆：" + "得给你找个异性才行");
		System.out.println("开始进行海选...");
		System.out.println("------------");
		//这个obj的引用是由CGLib给我们new出来的
		//cglib new出来以后的对象，是被代理对象的子类（继承了我们自己写的那个类）
		//OOP, 在new子类之前，实际上默认先调用了我们super()方法的，
		//new了子类的同时，必须先new出来父类，这就相当于是间接的持有了我们父类的引用
		//子类重写了父类的所有的方法
		//我们改变子类对象的某些属性，是可以间接的操作父类的属性的
		proxy.invokeSuper(obj, args);
		System.out.println("------------");
		System.out.println("如果合适的话，就准备办事");
		return null;
	}

}
```

