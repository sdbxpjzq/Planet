

```java
ArrayList<String> list = new ArrayList<>(Arrays.asList("PHP", "JAVA", "PYTHON", "GO"));
list.sort((str1,str2)->str2.length() - str1.length());
//输出: [PHP, JAVA, PYTHON, go]
```

