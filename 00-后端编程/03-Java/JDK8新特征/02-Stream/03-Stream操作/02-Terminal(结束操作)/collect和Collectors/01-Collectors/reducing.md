## reducing

这个方法非常有用！但是如果要了解这个就必须了解其参数 `BinaryOperator` 。

这是一个函数式接口，是给两个相同类型的量，返回一个跟这两个量相同类型的一个结果，伪表达式为 `(T,T) -> T`。默认给了两个实现 `maxBy` 和 `minBy` ，根据比较器来比较大小并分别返回最大值或者最小值。

当然你可以灵活定制。然后 `reducing` 就很好理解了，元素两两之间进行比较根据策略淘汰一个，随着轮次的进行元素个数就是 `reduce` 的。那这个有什么用处呢？Java 官方给了一个例子：统计每个城市最高的人。

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

