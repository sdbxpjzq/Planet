`java.text.Dateformat`是日期格式化子类的抽象类.

可以完成`Date对象`与`String对象`之间进行来回转换.



由于`DateFormat`为抽象类, 不能直接使用, 所以常用子类`java.text.SimpleDateFormat`.

String format(Date date):  日期 ---> 文本, 将Date格式换转成符合模式的字符串

Date parse(String source):  文本--> 日期, 将符合模式的字符串, 解析成Date日期.

## SimpleDateFormat

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

























