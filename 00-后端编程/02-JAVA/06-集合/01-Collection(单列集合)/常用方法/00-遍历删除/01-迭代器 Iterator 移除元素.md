```java
List<String> list = new ArrayList<>();
    list.add("Felordcn");
    list.add("Tomcat");
    list.add("Jetty");
    list.add("Undertow");
    list.add("Resin");
```

## 迭代器 Iterator 移除元素

```java
Iterator<String> iterator = list.iterator();
while (iterator.hasNext()) {
  String val = iterator.next();
  if (val.startsWith("F")) {
    // 这里移除
    iterator.remove();
  }
}
```

**迭代器iterator的remove()方法不仅会删除元素，还会维护一个标志，用来记录目前是不是可删除状态。**例如，你不能连续两次调用它的remove()方法，调用之前至少有一次next()方法的调用。

但是要注意的是：**list.remove()只是删除元素，可是不会改变原有元素的位置。**比如有 0 1 2 3 4 5这六个元素，我删除掉3这个元素，则4还是处于第四个位置，不会跳到第三个位置。

##### 



