`java.util.Iterator`

- Collection接口继承了`java.lang.Iterable接口`, 该接口有一个`iterator()`方法, 那所有实现了`Collection接口`的集合类都有一个`iterator()`方法, 用以返回一个实现了`iterator接口`的对象
- `Iterator`仅用于遍历集合, `Iterator`本身并不提供承装对象的能力.如果需要创建`Iterator`对象, 则必须有一个被迭代的集合.
- 集合对象每次调用`iterator()`方法, 都得到一个全新的迭代器对象, 默认游标都在`集合的第一个元素之前`

Iterator接口的常用方法如下：

- `public E next()`:返回迭代的下一个元素。
- `public boolean hasNext()`:如果仍有元素可以迭代，则返回 true。



```java
HashSet<Integer> set1 = new HashSet<>(Arrays.asList(1, 2, 3));
Iterator<Integer> iterator = set1.iterator();
while (iterator.hasNext()) {
  Integer val = iterator.next();
  System.out.println(val);
}
```

## 原理图

![](https://pic.superbed.cn/item/5dfed4ed76085c328917dfa7.jpg)







