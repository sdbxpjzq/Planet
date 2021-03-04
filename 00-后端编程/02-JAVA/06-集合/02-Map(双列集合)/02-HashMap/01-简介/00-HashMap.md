- 允许使用`null键`和`null值`,  不保证顺序
- key构成的集合是Set: 无序的, 不可重复的.  ==key所在的类要重写: `equals()`和`hashCode()`==

- value构成的集合是Collection: 无序的, 可以重复的. ==value所在的类要重写: `equals()`==
- 一个key-value构成一个entry





是一个线程不安全的集合, 是多线程的集合, 速度快

HashMap集合(除了HashTable):  可以存储`null`值, `null`键

代码实例:

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

