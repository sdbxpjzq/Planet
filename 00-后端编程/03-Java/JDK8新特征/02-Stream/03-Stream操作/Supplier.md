

> 通过实现Supplier类的方法可以自定义流计算规则



```java

示例：随机获取两条用户信息
System.out.println("自定义一个流进行计算输出:");
Stream.generate(new UserSupplier()).limit(2).forEach(u -> System.out.println(u.getId() + ", " + u.getName()));

//第一次:
//自定义一个流进行计算输出:
//10, pancm7
//11, pancm6

//第二次:
//自定义一个流进行计算输出:
//10, pancm4
//11, pancm2

//第三次:
//自定义一个流进行计算输出:
//10, pancm4
//11, pancm8


class UserSupplier implements Supplier<User> {
  private int index = 10;
  private Random random = new Random();

  @Override
  public User get() {
    return new User(index++, "pancm" + random.nextInt(10));
  }
}
```

