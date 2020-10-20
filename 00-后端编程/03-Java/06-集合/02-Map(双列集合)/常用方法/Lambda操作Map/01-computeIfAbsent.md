## computeIfAbsent

只有在当前Map中不存在key值的映射或映射值为null时，才调用mappingFunction，并在mappingFunction执行结果非null时，将结果跟key关联

Java8以前的代码

```java
Map<Integer, Set<String>> map = new HashMap<>();
if(map.containsKey(1)){
    map.get(1).add("PHP");
}else{
    Set<String> valueSet = new HashSet<String>();
    valueSet.add("PHP");
    map.put(1, valueSet);
}
```

使用lambda

```java
Map<Integer, Set<String>> map = new HashMap<>();
map.computeIfAbsent(1, v -> new HashSet<String>()).add("Java");
```



![](https://youpaiyun.zongqilive.cn/image/20200407172425.png)















