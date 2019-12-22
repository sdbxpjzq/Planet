

`HashSet`构造源码:

```java
public HashSet(Collection<? extends E> c) {
  map = new HashMap<>(Math.max((int) (c.size()/.75f) + 1, 16));
  addAll(c);
}
```

`HashSet`底层是`HashMap`.





![](https://pic.superbed.cn/item/5dfefd8b76085c3289266076.jpg)

