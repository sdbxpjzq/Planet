## mapping

该方法是先对元素使用 `Function` 进行再加工操作，然后用另一个`Collector` 归纳。比如我们先去掉 `servers` 中元素的首字母，然后将它们装入 `List` 。

```java
 // [elordcn, omcat, etty, ndertow, esin]
servers.stream.collect(Collectors.mapping(s -> s.substring(1), Collectors.toList()));
```

有点类似 `Stream` 先进行了 `map` 操作再进行 `collect` ：

```java
 servers.stream.map(s -> s.substring(1)).collect(Collectors.toList());
```