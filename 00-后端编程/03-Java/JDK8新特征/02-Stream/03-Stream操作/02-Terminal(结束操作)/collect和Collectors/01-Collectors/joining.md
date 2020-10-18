###  joining

将元素以某种规则连接起来。

```java
//   输出 FelordcnTomcatJettyUndertowResin
servers.stream().collect(Collectors.joining());

//   输出 Felordcn,Tomcat,Jetty,Undertow,Resin
servers.stream().collect(Collectors.joining("," ));

//   输出 [Felordcn,Tomcat,Jetty,Undertow,Resin]
servers.stream().collect(Collectors.joining(",", "[", "]"));
```

用的比较多的是读取 `HttpServletRequest` 中的 **body** ：

```java
HttpServletRequest.getReader().lines().collect(Collectors.joining());
```

