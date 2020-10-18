## summingInt/Double/Long

用来做累加计算。计算元素某个属性的总和,类似 **Mysql** 的 `sum` 函数，比如计算各个项目的盈利总和、计算本月的全部工资总和等等。我们这里就计算一下 `servers` 中字符串的长度之和 （为了举例不考虑其它写法）。

```java
// 总长度 32
list.stream.collect(Collectors.summingInt(s -> s.money()));
```

