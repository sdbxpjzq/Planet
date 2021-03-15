```
spring bean 容器的生命周期流程如下：

Spring 容器根据配置中的 bean 定义中实例化 bean。
Spring 使用依赖注入填充所有属性，如 bean 中所定义的配置。
如果 bean 实现 BeanNameAware 接口，则工厂通过传递 bean 的 ID 来调用 setBeanName()。
如果 bean 实现 BeanFactoryAware 接口，工厂通过传递自身的实例来调用 setBeanFactory()。
如果存在与 bean 关联的任何 BeanPostProcessors，则调用 preProcessBeforeInitialization() 方法。
如果为 bean 指定了 init 方法（<bean> 的 init-method 属性），那么将调用它。
最后，如果存在与 bean 关联的任何 BeanPostProcessors，则将调用 postProcessAfterInitialization() 方法。
如果 bean 实现 DisposableBean 接口，当 spring 容器关闭时，会调用 destory()。
如果为 bean 指定了 destroy 方法（<bean> 的 destroy-method 属性），那么将调用它。
```

![](https://youpaiyun.zongqilive.cn/image/20210314113849.png)



Bean 的生命周期概括起来就是 **4 个阶段**：

1. 实例化（Instantiation）；
2. 属性赋值（Populate）；
3. 初始化（Initialization）；
4. 销毁（Destruction）。



![](https://youpaiyun.zongqilive.cn/image/20210227163553.png)

![](https://youpaiyun.zongqilive.cn/image/20201213140149.png)



```java
protected Object doCreateBean(
  final String beanName, final RootBeanDefinition mbd,
  final @Nullable Object[] args) throws BeanCreationException {
  BeanWrapper instanceWrapper = null;
  if (instanceWrapper == null) {
    // 1. 说明不是 FactoryBean，实例化 Bean
    instanceWrapper = createBeanInstance(beanName, mbd, args);
  }
  // *** 解决循环依赖等
  Object exposedObject = bean;
  try {
    // 2. 前面实例化后，属性装配，自动注入
    populateBean(beanName, mbd, instanceWrapper);
    // 3. 初始化。init-method、InitializingBean、BeanPostProcessor等，各种回调
    exposedObject = initializeBean(beanName, exposedObject, mbd);
  } 
  try {
    // 4. 销毁-注册回调接口
    registerDisposableBeanIfNecessary(beanName, bean, mbd);
  }
  return exposedObject;
}
```







![](https://youpaiyun.zongqilive.cn/image/20210210162913.png)















