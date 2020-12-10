### 生命周期的回调

任何使用@Bean定义的bean，也可以执行生命周期的回调函数，类似`@PostConstruct `和 `@PreDestroy`的方法。用法如下:

默认使用javaConfig配置的bean，如果存在close或者shutdown方法，则在bean销毁时会自动执行该方法，如果你不想执行该方法，则添加@Bean(destroyMethod="")来防止出发销毁方法



针对单实例bean的话，容器启动的时候，bean的对象就创建了，而且容器销毁的时候，也会调用Bean的销毁方法

针对多实例bean的话,容器启动的时候，bean是不会被创建的而是在获取bean的时候被创建，而且bean的销毁不受IOC容器的管理.



```java
public class Foo {
    public void init() {
        // initialization logic
    }
}
 
public class Bar {
    public void cleanup() {
        // destruction logic
    }
}
 
@Configuration
public class AppConfig {
 
    @Bean(initMethod = "init")
    public Foo foo() {
        return new Foo();
    }
 
    @Bean(destroyMethod = "cleanup")
    public Bar bar() {
        return new Bar();
    }
 
}
```



### `@PostConstruct` 和`@ProDestory`标注的方法

```java
@Component 
public class Book {

  public Book() { System.out.println("book 的构造方法"); }

  @PostConstruct 
  public void init() { System.out.println("book 的PostConstruct标志的方法"); }

  @PreDestroy 
  public void destory() { System.out.println("book 的PreDestory标注的方法"); 
}

}
```

### `BeanPostProcessor`

通过Spring的BeanPostProcessor的bean的后置处理器会拦截所有bean创建过程

postProcessBeforeInitialization 在init方法之前调用

postProcessAfterInitialization 在init方法之后调用

```java
public class TulingBeanPostProcessor implements BeanPostProcessor {

    @Override
    public Object postProcessBeforeInitialization(Object bean, String beanName) throws BeansException {
        System.out.println("TulingBeanPostProcessor...postProcessBeforeInitialization:"+beanName);
        return bean;
    }

    @Override
    public Object postProcessAfterInitialization(Object bean, String beanName) throws BeansException {
        System.out.println("TulingBeanPostProcessor...postProcessAfterInitialization:"+beanName);
        return bean;
    }
}
```











