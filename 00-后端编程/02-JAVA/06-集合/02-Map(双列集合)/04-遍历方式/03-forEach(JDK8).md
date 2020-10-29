

```java
HashMap<String, Integer> map = new HashMap<>();
map.put("zongqi", 100);
map.put("xiaoli", 400);
map.put("lisi", 300);
map.forEach((k, v) -> {
  System.out.println(k);
  System.out.println(v);
});
```

