```java
List<String> list = new ArrayList<>();
    list.add("Felordcn");
    list.add("Tomcat");
    list.add("Jetty");
    list.add("Undertow");
    list.add("Resin");
```
## for 循环移除元素
让我们使用传统的 `foreach` 循环移除 `F`开头的假服务器，但是你会发现这种操作引发了
`ConcurrentModificationException`异常。

```java
// 错误的示范 千万不要使用
for (String s : list) {
  if (s.startsWith("F")) {
    list.remove(s);
  }
}
```

难道 for 循环就不能移除元素了吗？当然不是！我们如果能确定需要被移除的元素的`索引`还是可以的。

```java
// 这种方式是可行
for (int i = 0; i < list.size(); i++) {
  if (list.get(i).startsWith("F")) {
    list.remove(i);
  }
}
```