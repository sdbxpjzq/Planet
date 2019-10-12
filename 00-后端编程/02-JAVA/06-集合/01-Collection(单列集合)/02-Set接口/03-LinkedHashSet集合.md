`java.util.LinkedHashSet` 是`链表和哈希组合`的一个数据存储结构 . `有序集合`

是HashSet的子类.`java.util.LinkedHashSet集合 extends  HashSet集合`

## 特点

底层是一个`哈希表(数组+[链表 /红黑树])` + `链表`, 多了一条`链表(记录元素的存储顺序)`, 保证元素有序



```java
public static void main(String[] args) throws ParseException {
  HashSet<Integer> set1 = new HashSet<>();
  set1.add(1);
  set1.add(4);
  set1.add(3);
  print(set1);
  System.out.println("============");
  LinkedHashSet<Integer> set = new LinkedHashSet<>();
  set.add(1);
  set.add(4);
  set.add(3);
  print(set);
}

public static void print(Collection<?> list) {
  Iterator<?> iterator = list.iterator();
  while (iterator.hasNext()) {
    // 取出的都是Object, 可以接收任意类型的数据
    Object s = iterator.next();
    System.out.println(s);
  }
}
```

结果:

```
1
3
4
============
1
4
3
```

