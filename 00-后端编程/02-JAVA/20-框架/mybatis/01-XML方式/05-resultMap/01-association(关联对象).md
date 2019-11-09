## association定义关联对象

![](https://pic.superbed.cn/item/5dc665ab8e0e2e3ee9c9abff.jpg)



## association分步查询

![](https://pic.superbed.cn/item/5dc6660d8e0e2e3ee9c9b325.jpg)

## 分步查询&延迟加载

上边的分布查询, 每次查询都是一起查询出来

部门信息在我们使用的时候再去查询:
在分步查询的基础上再正佳两个配置:

```xml
<setting name="lazyLoadingEnabled" value="true"/>
<setting name="aggressiveLazyloading" value="false"/>
```