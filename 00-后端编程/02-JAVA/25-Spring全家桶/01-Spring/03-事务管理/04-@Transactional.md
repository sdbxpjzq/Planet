`@Transactional`注解, 可将事务织入到`public`方法中, 实现事务管理.

![](https://youpaiyun.zongqilive.cn/image/20200626093105.png)

## 注意点

- @Transactional 只能用`public`方法上, 对于`非public`方法, 虽然Spring不会报错, 但是不会将事务织入该方法中. 因为Spring会忽略掉所有非public方法上的@Transactional注解.
- 若@Transactional注解在类上, 则表示该类上的所有public方法都织入事务









## Spring 所支持的事务在什么条件下会出现事务失效，失效咋解决？

A 方法 B 方法都加了事务注解，A 方法调用了 B 方法。首先理解 Spring 事务是通过代理实现的，A 方法调用是代理过的，A 中调用 B 方法时，A 是 this 自己没有被代理，调用的 B 是自己的方法，没经过代理肯定没有事务。

怎么解决？1.自己注入自己，强制被代理；2.抽出一个方法 C，内部调用 A 和 B。









