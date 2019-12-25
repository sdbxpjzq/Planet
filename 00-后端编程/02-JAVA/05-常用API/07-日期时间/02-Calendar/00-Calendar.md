`java.util.Calendar`是日历类, 在`Date`后出现, 替换掉了许多`Date`的方法, 该类将所有可能用到的时间信息封装为`静态成员变量`, 方法获取.

**`Calendar类`就是方便获取各个时间属性的**

![](https://pic1.superbed.cn/item/5e02cdc676085c3289dfb28c.jpg)



## 获取方式

Calendar类为抽象类.

由于语言敏感性, Calendar类在创建对象的时候`并非直接创建`, 而是通过静态方法创建

```java
// 使用默认时区和语言环境获得一个日历.
Calendar calendar = Calendar.getInstance(); 
```



```java
Calendar calendar = Calendar.getInstance(); // 使用默认时区和语言环境获得一个日历.
int year = calendar.get(Calendar.YEAR);
int month = calendar.get(Calendar.MONTH);
int date = calendar.get(Calendar.DATE);
int dateOfMonth = calendar.get(Calendar.DAY_OF_MONTH); // 月中的某一天
int hour = calendar.get(Calendar.HOUR);
int min = calendar.get(Calendar.MINUTE);
int second = calendar.get(Calendar.SECOND);

```

```java
Calendar calendar = Calendar.getInstance(); // 使用默认时区和语言环境获得一个日历.
calendar.set(Calendar.YEAR, 2020);
```















