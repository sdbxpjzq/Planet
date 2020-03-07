

![](https://pic1.superbed.cn/item/5e02d4f376085c3289e2962c.jpg)

![](https://pic.superbed.cn/item/5e02d58876085c3289e2c9e3.jpg)

```java
// now: 获取本初子午线对应的标准时间, (不是系统时间)
Instant instant = Instant.now();
System.out.println(start); // 2020-03-01T10:35:38.733Z (和北京时间相差 8小时)

Date date = new Date();
System.out.println(date); // Sun Mar 01 18:35:38 CST 2020( 本地机器时间 北京时间)

// 增加偏移 8小时, 北京时间
OffsetDateTime offsetDateTime = instant.atOffset(ZoneOffset.ofHours(8));

// 获取
instant.toEpochMilli(); // 毫秒数 相当于 System.currentTimeMillis()

instant.getEpochSecond(); // 秒数
```



