只要标注了`@Controller`,`@Service`,`@Repository`,`@Component`, 都会扫描到

`MainConfig.java`

```java
@Configuration
@ComponentScan("com.atguigu")
public class MainConfig {
}
```

测试

```java
@Test
public void test01() {
  // IOC 容器
  AnnotationConfigApplicationContext applicationContext =
    new AnnotationConfigApplicationContext(MainConfig.class);
  String[] beanDefinitionNames = applicationContext.getBeanDefinitionNames();
  for (String name : beanDefinitionNames) {
    System.out.println(name);
  }
}
```

输出结果

默认都是 `首字母小写的`类名

```
mainConfig
bookController
bookService
bookDao
```

