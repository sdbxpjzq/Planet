##  @Builder

作用于类上，将类转变为建造者模式

`builder`是现在比较推崇的一种构建值对象的方式

```java
import lombok.Builder;
import lombok.Data;

@Builder
@Data
public class User {
    private String name;
    private Integer age;
}
```

```java
public class main {
    public static void main(String[] args) {
        User user = User.builder()
                .age(100)
                .name("zongqi")
                .build();
        System.out.println(user);
      // User(name=zongqi, age=100)
    }
}

```

`@Builder(toBuilder = true)` 说明:

用于修改之前对象的属性值, 当然 也完全可以使用`setXXX`方法.

```java
@Builder(toBuilder = true)
@Data
public class User {
    private String name = "hello";
    private Integer age;
}
```

```java
public class main {
    public static void main(String[] args) {
        User user = User.builder()
                .age(100)
                .name("zongqi")
                .build();
        // user.setAge(300);
        user = user.toBuilder().age(300).build();
        System.out.println(user);
      // User(name=zongqi, age=300)
    }
}
```