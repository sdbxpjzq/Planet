来根据环境来激活标识不同的Bean

`@Profile`标识在类上，那么只有当前环境匹配，整个配置类才会生效

`@Profile`标识在Bean上 ，那么只有当前环境的Bean才会被激活



```java

@Configuration
public class MyTestConfig {
    
    @Bean(name = "car")
    @Profile("development")
    public Car car1() {
        return new Car("开发环境");
    }


    @Bean(name = "car")
    @Profile("product")
    public Car car2() {
        return new Car("开发环境");
    }

}
```

