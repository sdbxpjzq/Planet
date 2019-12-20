## BeanFactory和ApplicationContext对比

	BeanFactory 采取延迟加载，第一次getBean时才会初始化Bean

![](https://pic.superbed.cn/item/5da9109e451253d1781c5670.jpg)

ApplicationContext 是及时加载,  会立即调用构造方法, 进行初始化





	ApplicationContext是对BeanFactory扩展，提供了更多功能
	国际化处理
	事件传递
	Bean自动装配
	各种不同应用层的Context实现



