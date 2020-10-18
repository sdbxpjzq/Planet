### collectingAndThen

该方法先执行了一个归纳操作，然后再对归纳的结果进行 `Function` 函数处理输出一个新的结果。

```java
 // 比如我们将servers joining 然后转成大写，结果为：FELORDCN,TOMCAT,JETTY,UNDERTOW,RESIN
 servers.stream.collect(Collectors.collectingAndThen(Collectors.joining(","), String::toUpperCase));
```

