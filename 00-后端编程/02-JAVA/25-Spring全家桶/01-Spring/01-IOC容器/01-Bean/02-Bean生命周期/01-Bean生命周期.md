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















