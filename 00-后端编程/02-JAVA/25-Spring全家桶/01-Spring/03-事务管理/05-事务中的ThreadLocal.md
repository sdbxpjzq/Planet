**怎么保证 Spring 事务内的连接唯一性**

答案只有一句话，因为那个 Connection 在事务开始时封装在了 ThreadLocal 里，后面事务执行过程中，都是从 ThreadLocal中 取的。肯定能保证唯一，因为都是在一个线程中执行。

```java
// threadLocal中要放一个map对象，key是dataSource，而value是connectionHolder
private static final ThreadLocal<Map<Object, Object>> resources =
      new NamedThreadLocal<>("Transactional resources");
```





