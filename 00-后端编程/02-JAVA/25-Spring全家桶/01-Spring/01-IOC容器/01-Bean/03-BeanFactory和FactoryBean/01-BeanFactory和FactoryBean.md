> 写再后面的是主语 

`FactoryBean`: 是由Spring工厂生产出的Bean, 所以叫`FactoryBean`, 而不是自己new出来的

是一个Bean,  是产生其他Bean实例. 仅提供一个工厂方法, 该方法返回其他Bean实例.

可以通过实现 FactoryBean 接口定制实例化 Bean 的逻辑，通过代理一个Bean对象，对方法前后做一些操作。

![](https://youpaiyun.zongqilive.cn/image/20201130164717.png)





`BeanFactory`

> 通过Spring获取Bean的最根本的接口。

是 Bean 的工厂， ApplicationContext 的父类，IOC 容器的核心，负责生产和管理 Bean 对象。

是管理Bean, 即实例化, 定位, 配置程序中的对象 以及建立Bean之间的依赖

- 提供IOC的配置机制
- 包含Bean的各种定义, 便于实例化Bean
- 建立Bean之间的依赖关系
- Bean生命周期的控制

![](https://youpaiyun.zongqilive.cn/image/20201130161611.png)





### **5. FactoryBean 和 BeanFactory有什么区别？**

BeanFactory 

FactoryBean 是 Bean，

### 

























