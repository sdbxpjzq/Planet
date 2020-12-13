IOC容器初始化包括 `BeanDefinition`的Resource定位, 载入和注册 

## 初始化三步走

- 定位资源(定位查找配置文件)

- 加载(已经找到配置文件)

- 注册(已经将加载好的配置文件解析出来, 并封装成`BeanDefinition`, 

  Bean的说明而已, bean还没有真正的产生)
  
  

- **第一个过程是Resource定位过程。** 这个 Resource定位指的是BeanDefinition的资源定位（例如我们平时Spring项目中配置的各种xml配置统一抽象为Resource资源），它由ResourceLoader通过统一的Resource接口来完成，这个Resource对这种形式的BeanDefinition的使用提供了统一接口。
- **第二个过程是BeanDefinition的载入过程。** 载入过程是把用户定义好的Bean表示成IOC容器内部的数据结构即BeanDefinition。BeanDefinition实际上就是POJO对象在IOC容器中的抽象，通过对BeanDefinition定义的数据结构，使IOC容器能够方便的对POJO对象也就是Bean对象进行管理。
- **第三个过程就是BeanDefinition的向IOC的注册过程。** 这个过程主要是通过BeanDefinitionRegistry接口完成实现的。注册过程是把载入过程中解析得到的BeanDefinition向IOC容器进行注册。其实IOC内部就是==将解析得到的BeanDefinition注入到一个HashMap中去==，IOC容器就是通过这个HashMap持有这些BeanDefinition数据的。





### Resource模块

 用于对所有资源`xml、txt、property`等==文件资源的抽象描述==

Resource 接口是 Spring 资源访问策略的抽象，它本身并不提供任何资源访问实现，具体的资源访问由该接口的实现类完成——每个实现类代表一种资源访问策略。

这里用到`策略模式`

Spring 为 Resource 接口提供了如下实现类：

- UrlResource：访问网络资源的实现类。
- ClassPathResource：访问类加载路径里资源的实现类。
- FileSystemResource：访问文件系统里资源的实现类。
- ServletContextResource：访问相对于 ServletContext 路径里的资源的实现类：
- InputStreamResource：访问输入流资源的实现类。
- ByteArrayResource：访问字节数组资源的实现类。

![](https://youpaiyun.zongqilive.cn/image/20201210165350.png)



### 加载器-ResourceLoader

负责对 Spring 资源的加载，资源指的是`xml`、`properties`等文件资源，返回一个对应类型的`Resource`对象

`ApplicationContext`,`AbstractApplication`是实现了`ResourceLoader`的，这说明什么呢？说明我们的应用上下文`ApplicationContext`拥有加载资源的能力，



### `bean`的定义-BeanDefinition

> 传统用纯java的方式怎么new对象 是 Student stu=new Student();的方式来实例化对象，
>
> 但是要交给spring的话，先通过springScan的方式扫描到类，当他扫描到的时候 他会去new一个`beanDefinition对象 `

SpringIOC容器管理了定义的各种Bean对象及其相互的关系, Bean对象在Spring实现中是以`BeanDefinition`来描述的

![](https://youpaiyun.zongqilive.cn/image/20201130153627.png)

配置文件中的`<bean/>`标签跟我们的`BeanDefinition`是一一对应的，`<bean>`元素标签拥有`class`、`scope`、`lazy-init`等配置属性，`BeanDefinition`则提供了相应的`beanClass`、`scope`、`lazyInit`属性。



`Spring`通过`BeanDefinition`将配置文件中的`<bean>`配置信息转换为容器的内部表示，并将这些`BeanDefiniton`注册到`BeanDefinitonRegistry`中。

`Spring`容器的`BeanDefinitionRegistry`就像是`Spring`配置信息的内存数据库，主要是以`map`的形式保存，后续操作直接从`BeanDefinitionRegistry`中读取配置信息。

一般情况下，`BeanDefinition`只在容器启动时加载并解析，除非容器刷新或重启，这些信息不会发生变化，当然如果用户有特殊的需求，也可以通过编程的方式在运行期调整`BeanDefinition`的定义。





### BeanDefinitionReader -- Resource资源转成BeanDefinition

Resource资源是怎么转成我们的BeanDefinition? 就是`BeanDefinitionReader`

<img src="https://youpaiyun.zongqilive.cn/image/20201210171257.png" style="zoom:150%;" />



### `BeanDefinitionRegistry` -- `BeanDefinition`注册到工厂

有了`BeanDefinition`后，你还必须将它们注册到工厂中去，所以当你使用`getBean()`方法时工厂才知道返回什么给你.

既然要保存注册这些`bean`, 那肯定要有个数据结构充当容器吧！没错，就是一个`Map`, 下面贴出`BeanDefinitionRegistry`的一个实现`SimpleBeanDefinitionRegistry`

```java
public class SimpleBeanDefinitionRegistry extends SimpleAliasRegistry implements BeanDefinitionRegistry {

	/** Map of bean definition objects, keyed by bean name. */
	private final Map<String, BeanDefinition> beanDefinitionMap = new ConcurrentHashMap<>(64);


  /**
  	* bean的名字作为key
  **/
	@Override
	public void registerBeanDefinition(String beanName, BeanDefinition beanDefinition)
			throws BeanDefinitionStoreException {

		Assert.hasText(beanName, "'beanName' must not be empty");
		Assert.notNull(beanDefinition, "BeanDefinition must not be null");
    // 放入map
		this.beanDefinitionMap.put(beanName, beanDefinition);
	}
  
  
}
```



### 小结

现在再梳理一下 Spring 初始化过程：

- 1、首先初始化上下文，生成`ClassPathXmlApplicationContext`对象，在获取`resourcePatternResolver`对象将`xml`解析成`Resource`对象。
- 2、利用 1 生成的 context、resource 初始化工厂，并将 resource 解析成 beandefinition, 再将 beandefinition 注册到 beanfactory 中。



看出`ApplicationContext`上下文基本直接或间接贯穿所有的部分，因此我们一般称之为`容器`，除此之外，`ApplicationContext`还拥有除了`bean容器`这种角色外，还包括了获取整个程序运行的环境参数等信息（比如 JDK 版本，jre 等），其实这部分 Spring 也做了对应的封装，称之为`Enviroment`, 





真正的IOC容器

`org.springframework.beans.factory.support.FactoryBeanRegistrySupport#factoryBeanObjectCache`

```java
	private final Map<String, Object> factoryBeanObjectCache = new ConcurrentHashMap<>(16);
```



```java
ApplicationContext context = new ClassPathXmlApplicationContext("classpath:/applicationContext.xml");
```

![](https://youpaiyun.zongqilive.cn/image/20201130155630.png)



![](https://youpaiyun.zongqilive.cn/image/20201212175038.png)





参考: https://mp.weixin.qq.com/s/JD8euIGcuoYp8g8lIVHM8g









