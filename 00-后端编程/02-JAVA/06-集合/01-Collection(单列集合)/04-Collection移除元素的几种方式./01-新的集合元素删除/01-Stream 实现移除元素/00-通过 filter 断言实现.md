我们可以使用 `Stream` 的 `filter` 断言。`filter` 断言会把符合断言的流元素汇集成一个新的流，然后归纳起来即可，于是我们可以这么写：

```java
// 跟以上不同的是 该方式中的断言是取反的操作。
list.stream().filter(s -> !s.startsWith("F")).collect(Collectors.toList());

```

这个优点上面已经说了不会影响原始数据，生成的是一个副本。缺点就是可能会有内存占用问题。