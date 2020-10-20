## computeIfPresent

作用跟computeIfAbsent()相反，即，只有在当前Map中存在key值的映射且非null时，才调用remappingFunction，如果remappingFunction执行结果为null，则删除key的映射，否则使用该结果替换key原来的映射．



```java
HashMap<String, Integer> map = new HashMap<>();
map.put("1", 1);
map.put("2", 2);
map.put("3", 3);
map.put("4", 3);
//只对map中存在的key对应的value进行操作
Integer integer = map.computeIfPresent("3", (k, v) -> v + 1);
System.out.printf("修改key=3得值为: %d\n", integer);
System.out.printf("修改后的map为: %s\n", map.toString());
// 触发remappingFunction，并返回执行结果为null，从而删除key=4
map.computeIfPresent("4", (k, v) -> {
    System.out.println("调用remappingFunction = [k=" + k + "; v=" + v + "]");
    return null;
});
System.out.printf("触发remappingFunction后的，map为: %s\n", map.toString());

/**
输出:
修改key=3得值为: 4
修改后的map为: {1=1, 2=2, 3=4, 4=3}
调用remappingFunction = [k=4; v=3]
触发remappingFunction后的，map为: {1=1, 2=2, 3=4}
*/
```

