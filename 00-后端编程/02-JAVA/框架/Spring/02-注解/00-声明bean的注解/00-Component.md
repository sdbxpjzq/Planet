```java
<!--1.在类中声明@Component 相当于配置了
<bean class="xxxx"></bean>
```

- @Component 组件，没有明确的角色
- 
- @Controller 在展现层使用，控制器的声明（C）
- @Service 在业务逻辑层使用（service层）
- @Repository 在数据访问层使用（dao层）
- 

```
"名称"选填
@Repository(“名称”)：dao层
@Service(“名称”)：service层
@Controller(“名称”)：web层
```

