

## maxBy/minBy

这两个方法分别提供了查找大小元素的操作，它们基于比较器接口 `Comparator` 来比较 ，返回的是一个 `Optional` 对象。我们来获取 `list` 中最小长度的元素:

```java
// Jetty
Optional<String> min = servers.stream.collect(Collectors.minBy(Comparator.comparingInt(String::length)));
```

这里其实 `Resin` 长度也是最小，这里遵循了 "先入为主" 的原则 。

当然 `Stream.min()` 可以很方便的获取最小长度的元素。`maxBy` 同样的道理。