```java
ArrayList<String> str1 = new ArrayList<>();
System.out.println(str1);// [], 重写了 toString 方法
Collection<String> str2 = new ArrayList<>(); // 可以使用多态的方式创建
str1.add("hello");
str2.add("world");
System.out.println(str1);
System.out.println(str2);
```

