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





