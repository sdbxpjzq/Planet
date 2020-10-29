## `Collection.removeIf()`

新的 `Collection` **Api** `removeIf(Predicate filter)` 。该 **Api** 提供了一种更简洁的使用 `Predicate` （断言）删除元素的方法，于是我们可以更加简洁的实现开始的需求：

```java
ArrayList<Integer> integers = new ArrayList<>(Arrays.asList(20, 420, 170, 100, 140));
integers.removeIf(number -> number < 100);
```

同时根据测试，`ArrayList` 和 `LinkedList` 的性能接近。一般推荐使用这种方式进行操作。

