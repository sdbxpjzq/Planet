# @Bean

这是一个方法级别上的注解, 主要用在`@Configuration`注解的类里，也可以用在`@Component`注解的类里。添加的`bean`的id为方法名

1.当项目中的类是自己编写的，则一般使用@controller、@service、@component等注解直接把bean交给spring管理。

2.当我们需要引入第三方库，并且也需要把第三方库中的类实例交给spring管理时，则使用@Bean、@Configuration注解



示例:

```java
@Configuration
public class AppConfig {
    @Bean
    public TransferService transferService() {
        return new TransferServiceImpl();
    }
}
```

这个配置就等同于之前在xml里的配置

```xml
<bean id="transferService" class="com.acme.TransferServiceImpl"/>
```

# bean的依赖

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

# 接受生命周期的回调

任何使用@Bean定义的bean，也可以执行生命周期的回调函数，类似@PostConstruct and @PreDestroy的方法。用法如下:

默认使用javaConfig配置的bean，如果存在close或者shutdown方法，则在bean销毁时会自动执行该方法，如果你不想执行该方法，则添加@Bean(destroyMethod="")来防止出发销毁方法



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

# 指定bean的scope

使用`@Scope`注解

```java
@Configuration
public class MyConfiguration {
    @Bean
    @Scope("prototype")
    public Encryptor encryptor() {
        // ...
    }
}
```

# 自定义bean的命名或别名

默认情况下bean的名称和方法名称相同，你也可以使用name属性来指定

```java
@Configuration
public class AppConfig {
 
    @Bean(name = "myFoo")
    public Foo foo() {
        return new Foo();
    }
 
}
```

bean的命名支持别名:

```java
@Configuration
public class AppConfig {
 
    @Bean(name = { "dataSource", "subsystemA-dataSource", "subsystemB-dataSource" })
    public DataSource dataSource() {
        // instantiate, configure and return DataSource bean...
    }
 
}
```

# bean的描述

有时候提供bean的详细信息也是很有用的，bean的描述可以使用 @Description来提供

```java
@Configuration
public class AppConfig {
 
    @Bean
    @Description("Provides a basic example of a bean")
    public Foo foo() {
        return new Foo();
    }
}
```





































