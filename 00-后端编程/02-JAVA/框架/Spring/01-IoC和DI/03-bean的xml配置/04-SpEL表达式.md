## 第一种

```
Spring 表达式
	对<property>进行统一编程，所有的内容都使用value
```

## 第二种

```
<property name="" value="#{表达式}">
#{123}、#{'jack'} ： 数字、字符串
#{beanId}	：另一个bean引用
#{beanId.propName}	：操作数据
#{beanId.toString()}	：执行方法
#{T(类).字段|方法}	：静态方法或字段
```

![](https://pic.superbed.cn/item/5daa62b8451253d178646707.jpg)

