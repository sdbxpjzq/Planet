## peek

> peek对每个元素执行操作并返回一个新的Stream

`peek`方法方法会使用一个Consumer消费流中的元素，但是返回的流还是包含原来的流中的元素。

peek接收一个没有返回值的λ表达式，可以做一些输出，外部处理等

map接收一个有返回值的λ表达式，之后Stream的泛型类型将转换为map参数λ表达式返回的类型



```java
// 双重操作
Stream.of("one", "two", "three", "four").filter(e -> e.length() > 3).peek(e -> System.out.println("转换之前: " + e))
  .map(String::toUpperCase).peek(e -> System.out.println("转换之后: " + e)).collect(Collectors.toList());

// 转换之前: three
// 转换之后: THREE
// 转换之前: four
// 转换之后: FOUR
```





```java
String[] arr = {"hello", "felord.cn"};
Stream<String> stream = Stream.of(arr);
stream.peek(System.out::println).count();
```

