## 基本类型--> String

有三种方式

### 方式1 -- 使用双引号拼接

```
34+""
```

### 方式2 -- 包装类的静态方法`toString(参数)`

```java
String i = Integer.toString(100);
System.out.println(i+100); // 100100
```

### 方式3 -- `String类`的静态方法`valueOf(参数)`

```java'
String i = String.valueOf(100);
System.out.println(i+100); // 100100
```