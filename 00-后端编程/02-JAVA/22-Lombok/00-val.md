## val

`val`作为常量申明

```java
public String example() {
    val example = new ArrayList<String>();
    example.add("Hello, World!");
    val foo = example.get(0);
    return foo.toLowerCase();
}
```

翻译成Java程序是：

```java
public String example() {
    final ArrayList<String> example = new ArrayList<String>();
    example.add("Hello, World!");
    final String foo = example.get(0);
    return foo.toLowerCase();
}
```