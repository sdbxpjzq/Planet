

```java
HashMap<String, Object> map = new HashMap<>();
map.put("name","zongqi");
map.put("age", 100);

List<String> result = new ArrayList(map.keySet());
List<Object> result2 = new ArrayList(map.values());

System.out.println(result2);
```

