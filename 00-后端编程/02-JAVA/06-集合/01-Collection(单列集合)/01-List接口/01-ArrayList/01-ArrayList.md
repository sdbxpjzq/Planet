## ArrayList

线程不安全的, 效率高; 底层使用 `Object[] elementData`存储

**增删慢, 查找快**



```java
ArrayList<String> str1 = new ArrayList<>();
System.out.println(str1);// [], 重写了 toString 方法
Collection<String> str2 = new ArrayList<>(); // 可以使用多态的方式创建
str1.add("hello");
str2.add("world");
System.out.println(str1);
System.out.println(str2);
```

## 底层实现

`ArrayList`底层是 `拷贝数组`, 修改的效率低

![](https://pic.superbed.cn/item/5da12399451253d178583029.jpg)





















