

`MainConfig.java`

```java
@Configuration // 告诉spring这是一个配置类
public class MainConfig {
  @Bean
  public Person person01() {
    return new Person(30, "lisi");
  }
}
```

### `@Bean`

```
1.给容器注册一个Bean, 类型为返回值的类型, 默认用方法名作为id
2.@Bean("id") 可以指定id, 支持多个 @Bean(name = { "dataSource", "subsystemA-dataSource", "subsystemB-dataSource" })
```



### `@Scope`

1. `@Scope`指定的作用域方法取值

* `singleton` 单实例的(默认), 而且是`饿汉加载`(容器启动实例就创建 好了)
* `prototype` 多实例的,而且还是`懒汉模式`加载（IOC容器启动的时候，并不会创建对象，而是 在第一次使用的时候才会创建）
* `request `同一次请求
* `session` 同一个会话级别





### `@Lazy`

```
主要针对单实例的bean 容器启动的时候，不创建对象，在第一次使用的时候才会创建该对象
```



### `@Conditional`

进行条件判断等

```java
public class TulingCondition implements Condition {
  @Override 
  public boolean matches(ConditionContext context, AnnotatedTypeMetadata metadata) {
    //判断容器中是否有tulingAspect的组件
    if(context.getBeanFactory().containsBean("tulingAspect")) {
      return true;
    }
    return false;
  }
}


//当切 容器中有tulingAspect的组件，那么tulingLog才会被实例化. 
@Bean 
@Conditional(value = TulingCondition.class) 
public TulingLog tulingLog() { return new TulingLog(); }
```





```java
public class MainTest {
  public static void main(String[] args) {
    // IOC 容器
    AnnotationConfigApplicationContext applicationContext = new AnnotationConfigApplicationContext(MainConfig.class);
    String[] beanDefinitionNames = ctx.getBeanDefinitionNames();
    for (String name : beanDefinitionNames) {
      System.out.println(name);
    }

    System.out.println(ctx.getBean("person"));
  }
}
```



### bean的依赖

@bean 也可以依赖其他任意数量的bean，如果TransferService 依赖 AccountRepository，我们可以通过方法参数实现这个依赖

```java
@Configuration
public class AppConfig {
 
    @Bean
    public TransferService transferService(AccountRepository accountRepository) {
        return new TransferServiceImpl(accountRepository);
    }
 
}
```


