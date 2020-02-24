这种方法虽然可以满足需要但是我感觉有点投机取巧的成份。

`Collectors.partitioningBy()` 方法本意是做二分类的。

该方法会将流中符合断言的、不符合断言的元素分别归纳到两个 `key` 分别为 `true` 和 `false` 的 `Map` 中，我们可以归类得到符合和不符合的元素集。实现如下：

```java
Map<Boolean, List<String>> f = servers.stream().collect(Collectors.partitioningBy(s -> !s.startsWith("F")));

List<String> trues = f.get(Boolean.TRUE);
System.out.println("不以 F 开头的：" + trues);

List<String> falses = f.get(Boolean.FALSE);
System.out.println("以 F 开头的：" + falses);
```

一般该方式不推荐在此场景使用，它并不符合该 **Api** 的设计意图。

##  