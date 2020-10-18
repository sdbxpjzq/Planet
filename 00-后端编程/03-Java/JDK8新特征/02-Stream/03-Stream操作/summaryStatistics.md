

> IntSummaryStatistics 用于收集统计信息(如count、min、max、sum和average)的状态对象。



示例:得到最大、最小、之和以及平均数。

```java
List<Integer> numbers = Arrays.asList(1, 5, 7, 3, 9);
IntSummaryStatistics stats = numbers.stream().mapToInt((x) -> x).summaryStatistics();

System.out.println("列表中最大的数 : " + stats.getMax());
System.out.println("列表中最小的数 : " + stats.getMin());
System.out.println("所有数之和 : " + stats.getSum());
System.out.println("平均数 : " + stats.getAverage());

// 列表中最大的数 : 9
// 列表中最小的数 : 1
// 所有数之和 : 25
// 平均数 : 5.0
```





Stream 介绍就到这里了，JDK1.8中的Stream流其实还有很多很多用法，更多的用法则需要大家去查看JDK1.8的API文档了。