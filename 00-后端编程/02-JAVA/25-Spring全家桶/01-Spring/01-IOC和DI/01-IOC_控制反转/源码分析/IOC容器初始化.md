IOC容器初始化包括 `BeanDefinition`的Resource定位, 载入和注册 

## 初始化三步走

- 定位资源(定位查找配置文件)

- 加载(已经找到配置文件)

- 注册(已经将加载好的配置文件解析出来, 并封装成`BeanDefinition`, 

  Bean的说明而已, bean还没有真正的产生)



真正的IOC容器

`org.springframework.beans.factory.support.FactoryBeanRegistrySupport#factoryBeanObjectCache`

```java
	private final Map<String, Object> factoryBeanObjectCache = new ConcurrentHashMap<>(16);
```



```java
ApplicationContext context = new ClassPathXmlApplicationContext("classpath:/applicationContext.xml");
```

![](https://youpaiyun.zongqilive.cn/image/20201130155630.png)

