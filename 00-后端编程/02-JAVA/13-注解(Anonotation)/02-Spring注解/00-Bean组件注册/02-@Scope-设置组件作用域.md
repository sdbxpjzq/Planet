```java
/**
     *
     * singleton - 单实例的 (默认值)
     * prototype - 多实例的
     * request: 同一请求创建一个实例
     * session: 同一个session 创建一个实例
     */
@Scope
@Bean
public Person person01() {
  return new Person(30, "zongqi");
}
```

## `singleton` - 单实例的 (默认值)































































































