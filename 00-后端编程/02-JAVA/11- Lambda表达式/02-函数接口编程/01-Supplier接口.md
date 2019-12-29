## Supplier接口

`java.util.function.Sipplier<T>`接口仅包含一个无参的方法: `T get()`

用来获取一个泛型参数指定类型的对象数据,





```java
import java.util.function.Supplier;

public class main {
  public static void main(String[] args) {
    String s = m1(() -> {
      return "hello world";
    });
    System.out.println(s);
  }

  public static String m1(Supplier<String> sup) {
    return sup.get();
  }
}


```

