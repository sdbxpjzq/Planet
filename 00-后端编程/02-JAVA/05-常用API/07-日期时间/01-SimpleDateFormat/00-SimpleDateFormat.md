

![](https://pic2.superbed.cn/item/5e02c84376085c3289dd8304.jpg)

## 格式化日期 

代码示例:

```java
SimpleDateFormat simpleDateFormat = new SimpleDateFormat();
Date date = new Date();
String format = simpleDateFormat.format(date);
System.out.println(format); // 19-12-25 上午10:26
```

```java
SimpleDateFormat simpleDateFormat = new SimpleDateFormat("yyyy-MM-dd hh:mm:ss");
Date date = new Date();
String format = simpleDateFormat.format(date);
System.out.println(format); // 2019-12-25 10:28:25
```





