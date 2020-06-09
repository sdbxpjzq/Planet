

```java
public static String getExceptionToString(Throwable e) {
  if (e == null){
    return "";
  }
  StringWriter stringWriter = new StringWriter();
  e.printStackTrace(new PrintWriter(stringWriter));
  return stringWriter.toString();
}
```

