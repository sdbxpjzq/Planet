- @Autowired：由Spring提供
- @Qualifier(“名称”):指定自动注入的id名称
- @Inject：由JSR-330提供
- @Resource：由JSR-250提供
- @Scope

都可以注解在set方法和属性上，推荐注解在属性上（一目了然，少写代码）。

@ PostConstruct 自定义初始化

@ PreDestroy 自定义销毁

![](https://pic.superbed.cn/item/5daa6738451253d17864c984.jpg)



