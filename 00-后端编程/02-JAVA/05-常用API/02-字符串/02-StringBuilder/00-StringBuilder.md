`java.lang.StringBuilder`:

字符串缓冲区, 可以提高字符串的效率.

![](https://pic.superbed.cn/item/5d9d3c09451253d17880f32c.jpg)

常用方法:

`public StringBuilder append(...)`: 添加任意类型数据的字符串形式, 并返回当前对象本身

`public String toString()`: 将`StringBuilder`对象转换成`String`对象

`public StringBuilder(String str)`: String ---> StringBuilder

```java
StringBuilder builder = new StringBuilder("hello");
builder.append(12).append('a'); // 可以连续追加
System.out.println(builder);

String string = builder.toString();
System.out.println(string);

```

