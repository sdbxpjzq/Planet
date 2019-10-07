当重写`equals`方法时, 使用到了`java.util.Objects`类.

该类提供了一些静态的方法来操作对象.



例如:

`public static boolean equals(Object a, Object b) `: 判断两个对象是否相等

```
public static boolean equals(Object a, Object b) {
    return (a == b) || (a != null && a.equals(b));
}
```

防止了抛出空指针异常.



