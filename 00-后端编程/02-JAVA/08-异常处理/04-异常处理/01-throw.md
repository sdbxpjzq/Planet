`throw`关键字, 用来抛出一个指定的异常对象

1. 创建异常类
2. `throw`抛出异常对象

格式

```java
throw new 异常类名(参数);
```

## 注意事项

1. `throw`关键字必须写在方法的内部

2. `throw`关键字后, `new`的对象必须是`Excetion`或者`Excetion`的子类

3. `throw`关键字抛出指定的异常对象, 我们就必须处理这个异常
   1. `throw`后创建的`RuntimeExcetion`或`RuntimeExcetion`的子类, 可以不处理,  默认交给`JVM`处理.(打印异常, 终端程序)
   2. `throw`后创建是编译异常, 必须处理这个异常, 要么`throws`, 要么`try ... catch`



![](https://pic.superbed.cn/item/5da439c89dc6d63695016f1b.jpg)

















