原生SPI机制通过ServiceLoader.load方法由外部指定类加载器，或者默认取Thread.currentThread().getContextClassLoader()线程上下文的类加载器，从而避免了class被载入bootstrap加载器。



2.SPI是否破坏了双亲委派

双亲委派的本质涵义是在rt.jar包和外部class之间建立一道classLoader的鸿沟，即rt.jar内的class不应由外部classLoader加载，外部class不应由bootstrap加载。

SPI仅是提供了一种在JDK代码内部干预外部class文件加载的机制，并未强制指定加载到何处；外部的class还是由外部的classLoader加载，未跨越这道鸿沟，也就谈不上破坏双亲委派。



原生ServiceLoader的类加载器:

```java
//指定类加载器
public static <S> ServiceLoader<S> load(Class<S> service,ClassLoader loader)
//默认取前线程上下文的类加载器
public static <S> ServiceLoader<S> load(Class<S> service)
```





https://mp.weixin.qq.com/s/xucuEvdzfQTtt9xDQMH7zQ

