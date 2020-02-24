当你希望创建一个全局静态Map的时候，我们有以下两种方式，而且是线程安全的。

在Test1中，我们虽然声明了map是静态的，但是在初始化时，我们依然可以改变它的值，就像Test1.map.put(3,"three");

在Test2中，我们通过一个内部类，将其设置为不可修改，那么当我们运行Test2.map.put(3,"three")的时候，它就会抛出一个UnsupportedOperationException 异常来禁止你修改。

```java

public class Test1 {

  private static final Map map;
  static {
    map = new HashMap();
    map.put(1, "one");
    map.put(2, "two");
  }
}

public class Test2 {

  private static final Map map;
  static {
    Map aMap = new HashMap();
    aMap.put(1, "one");
    aMap.put(2, "two");
    map = Collections.unmodifiableMap(aMap);
  }
}

```