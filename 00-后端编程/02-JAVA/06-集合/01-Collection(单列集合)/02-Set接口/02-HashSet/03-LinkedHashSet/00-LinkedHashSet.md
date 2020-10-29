- 是HashSet的子类.`java.util.LinkedHashSet集合 extends  HashSet集合`

- `LinkedHashSet`根据元素的`hashCode`值来决定元素的存储位置, 但同时使用`双向链表`维护元素的次序, [ 添加数据时 维护了两个引用, 记录此数据的 前一个数据 和 后一个数据]
- `LinkedHashSet`插入性能略低于`HashSet`, 但在迭代访问`Set`里的全部元素时有很好的性能
- `LinkedHashSet`不允许集合元素重复

## 优点

对于频繁的遍历操作, `LinkedHashSet`效率高于`HashSet`

代码实例:

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

