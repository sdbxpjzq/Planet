只要标注了`@Controller`,`@Service`,`@Repository`,`@Component`, 都会扫描到

`MainConfig.java`

```java
@Configuration
@ComponentScan("com.atguigu")
public class MainConfig {
}
```

`BookController.java`

```java
package com.atguigu.controller; // 在 com.atguigu 包下

import org.springframework.stereotype.Controller;

@Controller
public class BookController {
}
```

`BookService.java`

```java
package com.atguigu.dao; // 在 com.atguigu 包下

import org.springframework.stereotype.Service;

@Service
public class BookService {
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

