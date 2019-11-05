# 获取`Class`对象的方式

## `Class.forName("全类名")`

将字节码文件加载进内存, 返回`Class`对象

多用于配置文件, 将类名定义在配置文件中, 读取文件, 加载类

## `类名.class`

通过类名的属性`class`获取

多用于参数的传递

## `对象.getClass()`

`getClass()`方法在`Object`类中定义.

多用于对象获取字节码的方式



## 注意事项

同一个字节码文件(`*.class`)在一次程序运行过程中, 只会被加载一次, 不论通过哪一种方式获取的`Class`对象都是`同一个`

![](https://pic.superbed.cn/item/5dc168d08e0e2e3ee9149d2a.jpg)



![](https://pic.superbed.cn/item/5dc168768e0e2e3ee9149674.jpg)

















































