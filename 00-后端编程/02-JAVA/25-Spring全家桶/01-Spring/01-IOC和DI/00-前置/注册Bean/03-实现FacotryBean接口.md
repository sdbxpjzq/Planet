```java
public class CarFactoryBean implements FactoryBean<Car> {

  //返回bean的对象 
  @Override 
  public Car getObject() throws Exception { return new Car(); }

  //返回bean的类型 
  @Override 
  public Class<?> getObjectType() { return Car.class; }

  //是否为单利 
  @Override 
  public boolean isSingleton() { return true; }

}
```

```java
@Configuration // 告诉spring这是一个配置类
@Import({Person.class})
public class MainConfig {
    @Bean
    public CarFactoryBean carFactoryBean() {
        return new CarFactoryBean();
    }

```

