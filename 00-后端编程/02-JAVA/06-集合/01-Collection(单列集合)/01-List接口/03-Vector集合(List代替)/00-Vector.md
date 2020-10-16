## Vector

List接口的古老实现类, `线程安全的,效率低` ,底层使用 `Object[] elementData`存储

`Vector`类可以实现可增长的对象数组.与数组一样, 包含可以使用整数索引进行访问的组件, 但是`Vector`的大小可以根据需要增大或缩小, 以适应创建`Vector`后进行添加或移除项的操作.

![](https://pic.superbed.cn/item/5dfee3c676085c32891bb3c1.jpg)

从java2平台v.12开始, 此类改进为可实现`List`接口, 使他成为`Java Collection Framework`的成员, 但与新`Collection`实现不同, `Vector`是`同步的`.

**同步的说明是单线程的, 速度慢.** 

**之后的版本被`List`代替**





