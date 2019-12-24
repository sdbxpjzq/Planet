`java.lang.String`

- `String`是一个`final`类, 它的值再创建之后不能修改
- `Sting`对象的字符串内容是存储在一个`字符数组value[]`中的
- 是引用类型

```java
public final class String {
  private final char value[];
}
```

## 创建String的3种方式

### 字面量

程序中所有的`双引号字符串`

```java
String str = "hello";
```



### new String()

```java
String str1 = new String("hello");
```

`char[]`数组的方式:

```java
char[] charArr = {'h','e','l','l','o'};
String str3 = new String(charArr);
```

`byte[]`数组的方式:

```java
byte[] byteArr = {97, 98, 99};
String str3 = new String(byteArr); // abc
```

## 字符串特点

1. 字符串的内容永不可变
2. 正是因为字符串不可改变, 所以字符串是可以共享使用
3. 底层原理是`byte[]`字节数组

