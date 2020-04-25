设置`-Xms10m -Xmx10m -XX:+PrintGCDetails`

```java
String str = "www.zongqilive.cn";
while (true) {
  str += str + new Random().nextInt(888888)+new Random().nextInt(999999);
}

// Exception in thread "main" java.lang.OutOfMemoryError: Java heap space
```

![](https://youpaiyun.zongqilive.cn/image/20200318154343.png)





