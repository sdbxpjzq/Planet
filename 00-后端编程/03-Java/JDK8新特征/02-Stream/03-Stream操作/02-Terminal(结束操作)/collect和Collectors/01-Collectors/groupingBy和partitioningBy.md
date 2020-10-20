## groupingBy

```java
Map<Type, List<Dish>> result = dishList.stream().collect(Collectors.groupingBy(Dish::getType));
```



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

分区是特殊的分组，它分类依据是true和false，所以返回的结果最多可以分为两组

> 该方法会将流中符合断言的、不符合断言的元素分别归纳到两个 `key` 分别为 `true` 和 `false` 的 `Map` 中

```java
Map<Boolean,List<Dish>> result = menu.stream().collect(partitioningBy(Dish::isVegetarian))
```



示例二：分区排序

```java
System.out.println("通过年龄进行分区排序:");
Map<Boolean, List<User>> children = Stream.generate(new UserSupplier3()).limit(5)
  .collect(Collectors.partitioningBy(p -> p.getId() < 18));

System.out.println("小孩: " + children.get(true));
System.out.println("成年人: " + children.get(false));

// 通过年龄进行分区排序:
// 小孩: [{"id":16,"name":"pancm7"}, {"id":17,"name":"pancm2"}]
// 成年人: [{"id":18,"name":"pancm4"}, {"id":19,"name":"pancm9"}, {"id":20,"name":"pancm6"}]

class UserSupplier3 implements Supplier<User> {
  private int index = 16;
  private Random random = new Random();

  @Override
  public User get() {
    return new User(index++, "pancm" + random.nextInt(10));
  }
}
```



















