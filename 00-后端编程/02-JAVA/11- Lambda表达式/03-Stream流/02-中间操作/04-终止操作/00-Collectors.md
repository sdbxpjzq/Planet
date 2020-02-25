## 归纳进可变容器

作用是将元素分别归纳进可变容器 `List`、`Map`、`Set`、`Collection` 或者`ConcurrentMap` 

```
Collectors.toList();
Collectors.toMap();
Collectors.toSet();
Collectors.toCollection();
Collectors.toConcurrentMap();
```

##  joining

将元素以某种规则连接起来。

```java
//   输出 FelordcnTomcatJettyUndertowResin
servers.stream().collect(Collectors.joining());

//   输出 Felordcn,Tomcat,Jetty,Undertow,Resin
servers.stream().collect(Collectors.joining("," ));

//   输出 [Felordcn,Tomcat,Jetty,Undertow,Resin]
servers.stream().collect(Collectors.joining(",", "[", "]"));
```

用的比较多的是读取 `HttpServletRequest` 中的 **body** ：

```java
HttpServletRequest.getReader().lines().collect(Collectors.joining());
```

## collectingAndThen

该方法先执行了一个归纳操作，然后再对归纳的结果进行 `Function` 函数处理输出一个新的结果。

```java
 // 比如我们将servers joining 然后转成大写，结果为：FELORDCN,TOMCAT,JETTY,UNDERTOW,RESIN
 servers.stream.collect(Collectors.collectingAndThen(Collectors.joining(","), String::toUpperCase));
```

## groupingBy

按照条件对元素进行分组，和 **SQL** 中的 `group by` 用法有异曲同工之妙，通常也建议使用 **Java** 进行分组处理以减轻数据库压力。`groupingBy` 也有三个重载方法 我们将 `servers` 按照长度进行分组:

```java
// 按照字符串长度进行分组    
// 符合条件的元素将组成一个 List 映射到以条件长度为key 的 Map<Integer, List<String>> 中

servers.stream.collect(Collectors.groupingBy(String::length))
```

如果我不想 `Map` 的 `value` 为 `List` 怎么办？上面的实现实际上调用了下面的方式：

```java
 //Map<Integer, Set<String>>
 servers.stream.collect(Collectors.groupingBy(String::length, Collectors.toSet()))
```

我要考虑同步安全问题怎么办？当然使用线程安全的同步容器啊，那前两种都用不成了吧！别急！我们来推断一下，其实第二种等同于下面的写法:

```java
 Supplier<Map<Integer,Set<String>>> mapSupplier = HashMap::new;
 Map<Integer,Set<String>> collect = servers.stream.collect(Collectors.groupingBy(String::length, mapSupplier, Collectors.toSet()));
```

这就非常好办了，我们提供一个同步 `Map` 不就行了，于是问题解决了：

```java
 Supplier<Map<Integer, Set<String>>> mapSupplier = () -> Collections.synchronizedMap(new HashMap<>());

 Map<Integer, Set<String>> collect = servers.stream.collect(Collectors.groupingBy(String::length, mapSupplier, Collectors.toSet()));
```

其实同步安全问题 `Collectors` 的另一个方法 `groupingByConcurrent` 给我们提供了解决方案。用法和 `groupingBy` 差不多。

## partitioningBy

该方法会将流中符合断言的、不符合断言的元素分别归纳到两个 `key` 分别为 `true` 和 `false` 的 `Map` 中

## counting

该方法归纳元素的的数量

## maxBy/minBy

这两个方法分别提供了查找大小元素的操作，它们基于比较器接口 `Comparator` 来比较 ，返回的是一个 `Optional` 对象。我们来获取 `list` 中最小长度的元素:

```java
// Jetty
Optional<String> min = servers.stream.collect(Collectors.minBy(Comparator.comparingInt(String::length)));
```

这里其实 `Resin` 长度也是最小，这里遵循了 "先入为主" 的原则 。当然 `Stream.min()` 可以很方便的获取最小长度的元素。`maxBy` 同样的道理。

## summingInt/Double/Long

用来做累加计算。计算元素某个属性的总和,类似 **Mysql** 的 `sum` 函数，比如计算各个项目的盈利总和、计算本月的全部工资总和等等。我们这里就计算一下 `servers` 中字符串的长度之和 （为了举例不考虑其它写法）。

```java
// 总长度 32
list.stream.collect(Collectors.summingInt(s -> s.money()));
```

## summarizingInt/Double/Long

这三个方法通过对元素某个属性的提取，会返回对元素该属性的`统计数据对象`，

分别对应 `IntSummaryStatistics`、`DoubleSummaryStatistics`、`LongSummaryStatistics`。我们对 `servers` 中元素的长度进行统计：

```java
DoubleSummaryStatistics doubleSummaryStatistics = servers.stream.collect(Collectors.summarizingDouble(String::length));

// {count=5, sum=32.000000, min=5.000000, average=6.400000, max=8.000000}

System.out.println("doubleSummaryStatistics.toString() = " + doubleSummaryStatistics.toString());
```

结果 `DoubleSummaryStatistics` 中包含了 **总数，总和，最小值，最大值，平均值** 五个指标。

## mapping

该方法是先对元素使用 `Function` 进行再加工操作，然后用另一个`Collector` 归纳。比如我们先去掉 `servers` 中元素的首字母，然后将它们装入 `List` 。

```java
 // [elordcn, omcat, etty, ndertow, esin]
servers.stream.collect(Collectors.mapping(s -> s.substring(1), Collectors.toList()));
```

有点类似 `Stream` 先进行了 `map` 操作再进行 `collect` ：

```java
 servers.stream.map(s -> s.substring(1)).collect(Collectors.toList());
```

## reducing

这个方法非常有用！但是如果要了解这个就必须了解其参数 `BinaryOperator` 。这是一个函数式接口，是给两个相同类型的量，返回一个跟这两个量相同类型的一个结果，伪表达式为 `(T,T) -> T`。默认给了两个实现 `maxBy` 和 `minBy` ，根据比较器来比较大小并分别返回最大值或者最小值。当然你可以灵活定制。然后 `reducing` 就很好理解了，元素两两之间进行比较根据策略淘汰一个，随着轮次的进行元素个数就是 `reduce` 的。那这个有什么用处呢？Java 官方给了一个例子：统计每个城市最高的人。

```java
  Comparator<Person> byHeight = Comparator.comparing(Person::getHeight);

     Map<String, Optional<Person>> tallestByCity = people.stream().collect(Collectors.groupingBy(Person::getCity, Collectors.reducing(BinaryOperator.maxBy(byHeight))));

```

结合最开始给的例子你可以使用 `reducing` 找出最长的字符串试试。

上面这一层是根据 `Height` 属性找最高的 `Person` ，而且如果这个属性没有初始化值或者没有数据，很有可能拿不到结果所以给出的是 `Optional`。如果我们给出了 `identity` 作一个基准值，那么我们首先会跟这个基准值进行 `BinaryOperator` 操作。比如我们给出高于 2 米 的人作为 `identity`。我们就可以统计每个城市不低于 2 米 而且最高的那个人，当然如果该城市没有人高于 2 米则返回基准值`identity` ：

```java
 Comparator<Person> byHeight = Comparator.comparing(Person::getHeight);
 Person identity= new Person();
           identity.setHeight(2.);
           identity.setName("identity");
     Map<String, Person> collect = persons.stream()
                        .collect(Collectors.groupingBy(Person::getCity, Collectors.reducing(identity, BinaryOperator.maxBy(byHeight))));
```

这时候就确定一定会返回一个 `Person` 了，最起码会是基准值`identity` 不再是 `Optional` 。

还有些情况，我们想在 `reducing` 的时候把 `Person` 的身高先四舍五入一下。这就需要我们做一个映射处理。定义一个 `Function mapper` 来干这个活。那么上面的逻辑就可以变更为：

```java
Comparator<Person> byHeight = Comparator.comparing(Person::getHeight);
Person identity = new Person();
identity.setHeight(2.);
identity.setName("identity");
// 定义映射 处理 四舍五入
Function<Person, Person> mapper = ps -> {
  Double height = ps.getHeight();

  BigDecimal decimal = new BigDecimal(height);
  Double d = decimal.setScale(1, BigDecimal.ROUND_HALF_UP).doubleValue();
  ps.setHeight(d);
  return ps;
};
Map<String, Person> collect = persons.stream()
  .collect(Collectors.groupingBy(Person::getCity, Collectors.reducing(identity, mapper, BinaryOperator.maxBy(byHeight))));
```



## averagingInt

计算流种的Integer属性 平均值





