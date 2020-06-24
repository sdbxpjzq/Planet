```java
// 序列化
Gson gson = new Gson();
gson.toJson(1);            // ==> 1
gson.toJson("abcd");       // ==> "abcd"
gson.toJson(new Long(10)); // ==> 10
int[] values = { 1 };
gson.toJson(values);       // ==> [1]

// 反序列化
int one = gson.fromJson("1", int.class);
Integer one = gson.fromJson("1", Integer.class);
Long one = gson.fromJson("1", Long.class);
Boolean false = gson.fromJson("false", Boolean.class);
String str = gson.fromJson("\"abc\"", String.class);
String[] anotherStr = gson.fromJson("[\"abc\"]", String[].class);
```

**注意事项**

- 建议使用 private 修饰属性。
- 不需要使用任何注解来表明一个属性是否应该序列化和反序列化。默认情况下，当前类的所有属性（以及从父类继承的属性）都将被参与序列化和反序列化。
- 如果一个属性被 `transient` 修饰，默认情况下该属性会被忽略掉，并且不参与 JSON 的序列化和反序列化。
- 上面介绍的实现方式可以正确地处理 null。
- 在序列化的时候，一个值为 null 的字段不会在输出中出现。
- 在反序列化时，JSON中缺少的条目导致将对象中的相应字段设置为null。
- 如果一个字段被 `synthetic` 修饰，则该属性会被忽略，并且不参与 JSON 的序列化和反序列化。
- 与内部类，匿名类和局部类中的外部类对应的字段将被忽略，并且不会包含在序列化或反序列化中。

```java
class BagOfPrimitives {
  private int value1 = 1;
  private String value2 = "abc";
  private transient int value3 = 3;
  BagOfPrimitives() {
    // 无参构造方法
  }
}

// 序列化
BagOfPrimitives obj = new BagOfPrimitives();
Gson gson = new Gson();
String json = gson.toJson(obj);  

// ==> json is {"value1":1,"value2":"abc"}
```

