## merge

>  key存在则更新，不存在则赋值

一个比较常见的场景是将新的错误信息拼接到原来的信息上，比如：

```java
HashMap<String, String> stringStringHashMap = new HashMap<>(1);
stringStringHashMap.put("error", "执行错误,");
System.out.println(stringStringHashMap); // {error=执行错误}
// 使用merge
stringStringHashMap.merge("error", "其他错误信息.....", (v1, v2) -> v1 + v2);
System.out.println(stringStringHashMap); // {error=执行错误,其他错误信息.....}

```

