`peek`方法方法会使用一个Consumer消费流中的元素，但是返回的流还是包含原来的流中的元素。

peek接收一个没有返回值的λ表达式，可以做一些输出，外部处理等

map接收一个有返回值的λ表达式，之后Stream的泛型类型将转换为map参数λ表达式返回的类型



```java
String[] arr = {"hello", "felord.cn"};
Stream<String> stream = Stream.of(arr);
stream.peek(System.out::println).count();
```

