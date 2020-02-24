## distinct

`distinct`保证输出的流中包含唯一的元素，它是通过`hashCode()`和`equals()`来检查是否包含相同的元素。

```java
List<String> l = Stream.of("a","b","c","b")
        .distinct()
        .collect(Collectors.toList());
System.out.println(l); //[a, b, c]
```