Gson 支持一些预定义的命名策略，以便将标准 Java 字段命名方式（比如，驼峰命名法则，要求变量名以小写字母开头 —— `sampleFieldNameInJava`）转为常见的 Json 字段名称（比如 `sample_field_name_in_java` 或 `SampleFieldNameInJava`)。

## @SerializedName()

Gson 也提供一种基于注解的方法，允许客户端使用 `@SerializedName()` 注解，为每一个字段自定义名称。注意，这种方法有可能会产生运行时异常。



```java
private class SomeObject {
  @SerializedName("custom_naming")
  private final String someField;
  private final String someOtherField;

  public SomeObject(String a, String b) {
    this.someField = a;
    this.someOtherField = b;
  }
}

SomeObject someObject = new SomeObject("first", "second");
Gson gson = new GsonBuilder().setFieldNamingPolicy(FieldNamingPolicy.UPPER_CAMEL_CASE).create();
String jsonRepresentation = gson.toJson(someObject);
System.out.println(jsonRepresentation);
```

