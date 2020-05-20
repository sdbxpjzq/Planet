## `@PostConstruct`

用途: 被注解的方法，在对象加载完依赖注入后执行

```
javax.annotation.PostConstruct
```

总体概括如上，注意其中几个点

1. 要在依赖加载后，对象使用前执行，**而且只执行一次**
2. 方法不允许有参数, 也没有返回值(`void`)
3. 方法不可以是`static`的，但可以是`final`的
4. 方法的权限修饰,` public`、`protected`、`private`都可以

### 执行循序

> Constructor > @Autowired > @PostConstruct

先执行完构造方法，再注入依赖，最后执行初始化操作，所以这个注解就避免了一些需要在构造方法里使用依赖组件的尴尬。



```java
@Configuration
public class MyConfigurationTest {
	public MyConfigurationTest() {
		System.out.println("构造方法被调用");
	}

	@PostConstruct
	private void init() {
		System.out.println("PostConstruct注解方法被调用");
	}

	@PreDestroy
	private void shutdown() {
		System.out.println("PreDestroy注解方法被调用");
	}
}

/**

**/
```

Java 9中弃用 `@PostConstruct`和`@PreDestroy`这两个注解 ，并计划在Java 11中将其删除。我们有什么更好的替代方法吗？当然有！而且，我比较推荐使用这种方式。

```java
@Configuration
publicclass MyConfigurationTest implements InitializingBean, DisposableBean {
    public MyConfiguration2() {
        System.out.println("构造方法被调用");
    }

    @Override
    public void afterPropertiesSet() {
        System.out.println("afterPropertiesSet方法被调用");
    }

    @Override
    public void destroy() {
        System.out.println("destroy方法被调用");
    }

}

```

## `@PreDestroy`

在对象消亡之前执行





































