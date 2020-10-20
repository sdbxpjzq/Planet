## compute

> 作用是把remappingFunction的计算结果关联到key上，如果计算结果为null，则在Map中删除key的映射．



```java
List<String> list = Arrays.asList("a", "b", "b", "c", "c", "c", "d", "d", "d", "f", "f", "g");
System.out.println("使用 compute 计算元素出现的次数:");
Map<String, Integer> countsMap = new HashMap<>(6);
// 此时：新值 = 旧值 + 1
list.forEach(str -> countsMap.compute(str, (k, v) -> v == null ? 1 : v + 1));
System.out.println(countsMap);
/**
使用 compute 计算元素出现的次数:
{a=1, b=2, c=3, d=3, f=2, g=1}
*/
```

