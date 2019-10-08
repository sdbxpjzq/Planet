`java.util.Date`类表示时间,  精确到 `毫秒`

```java
Date date1 = new Date();
Date date2 = new Date(0L);
long time = System.currentTimeMillis();// 当前系统时间的毫秒数
```

无参构造, 自动设置当前系统时间

指定`long类型`的构造参数, 可自定义毫秒时刻