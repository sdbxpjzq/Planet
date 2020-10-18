## summarizingInt/Double/Long

这三个方法通过对元素某个属性的提取，会返回对元素该属性的`统计数据对象`，

分别对应 `IntSummaryStatistics`、`DoubleSummaryStatistics`、`LongSummaryStatistics`。我们对 `servers` 中元素的长度进行统计：

```java
DoubleSummaryStatistics doubleSummaryStatistics = servers.stream.collect(Collectors.summarizingDouble(String::length));

// {count=5, sum=32.000000, min=5.000000, average=6.400000, max=8.000000}

System.out.println("doubleSummaryStatistics.toString() = " + doubleSummaryStatistics.toString());
```

结果 `DoubleSummaryStatistics` 中包含了 **总数，总和，最小值，最大值，平均值** 五个指标。