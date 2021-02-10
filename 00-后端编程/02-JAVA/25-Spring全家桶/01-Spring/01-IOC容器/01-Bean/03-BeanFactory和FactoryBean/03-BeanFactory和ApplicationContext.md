## BeanFactory

BeanFactory 是Spring框架的基础设施, 面向Spring

ApplicationContext面向使用Spring框架的开发者





## ApplicationContext(继承多个接口)

- 继承`BeanFacory`: 能够管理, 装配Bean
- 继承`ResourcePatternResolver`: 能够加载资源文件
- 继承`MessageSoure`: 能够实现国际化能功能
- 继承`ApplicationEventPublisher`: 能够注册监听器, 实现监听机制



![](https://youpaiyun.zongqilive.cn/image/20201130152702.png)



xml配置文件

![](https://youpaiyun.zongqilive.cn/image/20200624142543.png)

通过id获取对象

![](https://youpaiyun.zongqilive.cn/image/20200624142558.png)

![](https://youpaiyun.zongqilive.cn/image/20200624142648.png)

`