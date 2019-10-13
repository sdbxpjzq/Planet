存储数据采用的`哈希表结构`, 查询的速度特别快

数组+单向链表/红黑树 (链表的长度超过8), 提高查询的速度



```java
public static void main(String[] args) {
  HashMap<String, Integer> map = new HashMap<>();
  map.put("zongqi", 100);
  map.put("xiaoli", 400);
  map.put("lisi", 300);
  Integer oldValue = map.put("lisi", 400); // key 重复, 返回旧值, 替换新值
  System.out.println(oldValue); // 300
  System.out.println(map);
}
```

