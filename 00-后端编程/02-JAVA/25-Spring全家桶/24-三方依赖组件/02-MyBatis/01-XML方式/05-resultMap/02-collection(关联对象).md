## collection定义关联对象

![](https://pic.superbed.cn/item/5dc6688c8e0e2e3ee9c9e5b9.jpg)

## collection分步查询&延迟加载

![](https://pic.superbed.cn/item/5dc668aa8e0e2e3ee9c9e8d6.jpg)





## 分步查询&延迟加载

上边的分布查询, 每次查询都是一起查询出来

部门信息在我们使用的时候再去查询:
在分步查询的基础上再正佳两个配置:

```xml
<setting name="lazyLoadingEnabled" value="true"/>
<setting name="aggressiveLazyloading" value="false"/>
```

 