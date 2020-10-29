内部原理也是`Iterator`迭代器, 所以在遍历的过程中, **不能对集合中的元素进行增删操作**

格式:

```java
for(元素的数据类型   变量 : Collection集合or数组) {
  // 操作
}
// 通常只进行遍历元素, 不要再遍历的过程中对集合元素进行增删操作
```

```java
ArrayList<String> str1 = new ArrayList<>();
str1.add("hello");
str1.add("world");
for (String s :
     str1) {
  System.out.println(s);
}
```

