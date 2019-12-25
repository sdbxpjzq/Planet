

![](https://pic2.superbed.cn/item/5e02c84376085c3289dd8304.jpg)

## 格式化日期 

### 模式匹配: 区分大小写

```
y -- 年
M -- 月
d -- 日

H -- 时
m -- 分
s -- 秒

```



### format

```java
// 将当前系统时间进行 格式化
Date date = new Date();
SimpleDateFormat simpleDateFormat = new SimpleDateFormat("yyyy-M-d H:m:s");
System.out.println(simpleDateFormat.format(date));
```

### parse

```java
SimpleDateFormat simpleDateFormat = new SimpleDateFormat("yyyy-MM-dd");
// 字符串的格式 要和 构造时的保持一致
Date parse = simpleDateFormat.parse("2088-08-08");
System.out.println(parse);
```

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





