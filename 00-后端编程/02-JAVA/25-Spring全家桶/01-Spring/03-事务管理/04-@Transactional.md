`@Transactional`注解, 可将事务织入到`public`方法中, 实现事务管理.

![](https://youpaiyun.zongqilive.cn/image/20200626093105.png)

## 注意点

- @Transactional 只能用`public`方法上, 对于`非public`方法, 虽然Spring不会报错, 但是不会将事务织入该方法中. 因为Spring会忽略掉所有非public方法上的@Transactional注解.
- 若@Transactional注解在类上, 则表示该类上的所有public方法都织入事务





















