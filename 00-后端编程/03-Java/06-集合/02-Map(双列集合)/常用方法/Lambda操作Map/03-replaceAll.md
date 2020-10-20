## replaceAll

> 对Map中的每个映射执行function指定的操作，并用function的执行结果替换原来的value，



```java
HashMap<Integer,String> map = new HashMap<>();
map.put(1, "c");
map.put(2, "go");
map.put(3, "java");
map.put(4, "php");
map.replaceAll((k,v)->v.toUpperCase());
System.out.println(map);
// 输出:{1=C, 2=GO, 3=JAVA, 4=PHP}
```

