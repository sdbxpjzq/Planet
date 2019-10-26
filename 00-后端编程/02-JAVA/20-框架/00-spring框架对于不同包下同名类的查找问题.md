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

-->(buildDefaultBeanName) --> C(ClassUtils.getShortName)

```mermaid
graph LR
generateBeanName
-->buildDefaultBeanName

```













