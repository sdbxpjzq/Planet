简单说，就是有不同包下的类重名了。



![](https://pic.superbed.cn/item/5db3a38c8b58bc7bf71841b6.jpg)



## 源码查看

接口层`org.springframework.beans.factory.support.BeanNameGenerator`

该接口有2个实现类

```
DefaultBeanNameGenerator
AnnotationBeanNameGenerator
```

- DefaultBeanNameGenerator是给资源文件加载bean时使用（BeanDefinitionReader中使用）；

- AnnotationBeanNameGenerator是为了处理注解生成bean name的情况。



对TestSpring使用的是@Service修饰，因此，我们使用的是AnnotationBeanNameGenerator的实现。

```
// 方法调用
generateBeanName --> buildDefaultBeanName --> ClassUtils.getShortName
```

![](https://pic.superbed.cn/item/5db3abf38b58bc7bf7190c0b.jpg)

![](https://pic.superbed.cn/item/5db3ac088b58bc7bf7190de0.jpg)

所以, 最终转换成`shortName`.

```java
@Service
class TestSpring
```

则`beanName`为`testSpring`。
鉴于此，我们不同包下的同名类会造成beanName重复，从而报错。



## 总结

spring并不支持不同的包下类名相同的设定。这是因为默认的spring检索bean的唯一id(@Service,@Component等)为bean的name，并不包含package name信息。想要规避这种问题有两种方式
 a 对bean显式命名，@Service("yourName")
 b 使用xml的方式声明bean


