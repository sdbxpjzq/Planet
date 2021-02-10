导入组件的id为全类名路径:

`com.magical.service.spring源码.Person`

```java
@Configuration // 告诉spring这是一个配置类
@Import({Person.class})
public class MainConfig {

}

```

