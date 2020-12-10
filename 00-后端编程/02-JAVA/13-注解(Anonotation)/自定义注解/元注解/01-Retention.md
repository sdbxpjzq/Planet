

## `@Retention`: 描述注解被保留的阶段 (有3个阶段)

定义了该Annotation被保留的时间长短

`@Retention(RetentionPolicy.RUNTIME)`: 当前被描述的注解, 会保留到class字节码文件中, 并被jvm读取到

指定属性:

- SOURCE 源文件中有效
- CLASS 在class文件中有效 -- 默认值
- RUNTIME 运行时有效

![](https://pic.superbed.cn/item/5e0a9cff76085c3289f1c4e2.jpg)





