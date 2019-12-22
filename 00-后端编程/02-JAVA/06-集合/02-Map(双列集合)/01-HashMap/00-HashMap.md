存储数据采用的`哈希表结构`, 查询的速度特别快

![](https://pic2.superbed.cn/item/5dff093676085c32892cfaf5.jpg)

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

