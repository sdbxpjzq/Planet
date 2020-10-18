```java
Stream stream = Stream.of("a", "b", "c");

String[] strArray = new String[] { "a", "b", "c" };
stream = Stream.of(strArray);

stream = Arrays.stream(strArray);

List<String> list = Arrays.asList(strArray);
stream = list.stream();
```






## 方式2_Stream的of()方法

`Stream`接口的静态方法`of()`可以获取数组对应的流.

数组转换成Stream流:

```java
Stream<Integer> stream6 = Stream.of(1,2,3,4);
// 可以传递传递数组
Internet[] arr = {1,2,3,4};
Stream<Integer> stream7 = Stream.of(arr);

```

## 方式3_Arrays的stream()方法

![](https://pic.superbed.cn/item/5e0dd52f76085c3289662614.jpg)

```java
String[] values = { "aaa", "bbbb", "ddd", "cccc" };
Arrays.stream(values).forEach(s -> System.out.println(s));
```

## 原始流 (`primitive streams`)转换成

原始流:

```java
IntStream intStream = IntStream.of(1, 2, 3);
DoubleStream doubleStream = DoubleStream.of(1.0, 2.0, 3.0);
```

### 可以使用`Arrays.stream()`方法构造

```java
IntStream intStream = Arrays.stream(new int[]{ 1, 2, 3 });
```

指定范围的数组创建一个Stream

```java
int[] values= new int[]{1, 2, 3, 4, 5};
IntStream intStram = Arrays.stream(values, 1, 3);
```

### 使用boxed方法转换为boxed类型流

```java
List<Integer> collect = IntStream.of(1, 2, 3).boxed().filter(num -> num > 2).collect(Collectors.toList());
System.out.println(collect);
```

这在某些情况下可能是有用的，如果你想收集数据，因为primitive streams (原始流)没有任何可以需要一个Collector来作为参数的collect方法。

## 方式4_创建无限流

![](https://pic.superbed.cn/item/5e0dd56976085c3289662ce8.jpg)

![](https://pic.superbed.cn/item/5e0dd57676085c3289662e49.jpg)

















































