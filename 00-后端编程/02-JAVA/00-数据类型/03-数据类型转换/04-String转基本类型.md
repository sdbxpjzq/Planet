## String --> 基本类型

### 方式1-- 使用包装类的静态方法

除了`character类`之外, 其他包装类都具有静态方法`parsexxx("字符串")`

![](https://pic.superbed.cn/item/5d9fe1d6451253d1787b6915.jpg)

```java
int i = Integer.parseInt("100");
System.out.println(i+100); // 200

int i = Integer.parseInt("a"); // 抛出异常NumberFormatException
```

