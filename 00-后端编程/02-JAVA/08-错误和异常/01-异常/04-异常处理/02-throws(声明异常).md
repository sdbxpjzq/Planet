## throws

将异常交给调用者处理

作用:

当方法内部抛出异常对象的时候, 那么我们就必须处理这个异常对象

使用`throws`处理异常对象, 会将异常对象声明抛出给调用者处理(自己不处理, 给别人处理), 最终交给`JVM`处理(中断出处理)



## 注意事项

1. `throws`必须写在方法声明处

2. `throws`关键字后边声明的异常必须是`Exception`或`Exception`的子类

3. 方法内如果抛出了多个异常对象, 那么`throws`后边也必须声明多个异常
   1. 如果抛出的异常对象有父子关系, 那么直接声明父类异常即可
4. 调用了一个声明抛出异常的方法, 我们就必须处理声明的异常
   1. 要么继续使用`throws`声明抛出, 交给方法的调用者处理, 最终交给`JVM`
   2. 要么`try...catch`自己处理声明异常



![](https://pic.superbed.cn/item/5da46e05451253d178879acf.jpg)











