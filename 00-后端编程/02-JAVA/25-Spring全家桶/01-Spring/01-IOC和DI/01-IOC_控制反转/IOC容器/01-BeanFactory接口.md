## 最基本的IOC容器--BeanFactory

spring容器中具有代表性的容器就是BeanFactory接口，这个是spring容器的顶层接口，提供了容器最基本的功能。

`org.springframework.beans.factory.BeanFactory`

![](https://youpaiyun.zongqilive.cn/image/20201130151831.png)



`BeanFactory`作为最顶层的一个接口类, 它定义了IOC容器的最基本功能规范

有三个子类`ListableBeanFactory``HierarchicalBeanFactory`和`AutowireCapacleBeanFactory`

但是通过上图可以发现,最终的默认实现类是`DefaultListableBeanFactory`, 这个类实现了所有的接口.



为什么要定义这么多接口呢?

为了区分Spring在内部操作对象的传递和转化过程中, 对 对象的数据访问所做的限制,

例如: `ListableBeanFactory`接口表示Bean是可列表的, `HierarchicalBeanFactory`表示Bean是有继承关系的, 也就这这个每个Bean有可能有父Bean.

`AutowireCapacleBeanFactory`接口定义Bean的自动装配规则,

综上, 这四个接口共同定义了Bean的集合, Bean之间的关系, 和Bean的行为







## 两种IOC容器

1. `XmlBeanFactory`
2. `ApplicationContext`



























