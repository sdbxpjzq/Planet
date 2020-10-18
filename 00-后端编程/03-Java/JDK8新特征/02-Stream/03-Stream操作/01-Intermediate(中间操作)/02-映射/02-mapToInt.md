mapToInt(ToIntFunction f)

接收一个函数作为参数, 该函数会被应用到每个元素上,产生新的stream



```java
List<User> lists = new ArrayList<User>();
 lists.add(new User(6, "张三"));
 lists.add(new User(2, "李四"));
 lists.add(new User(3, "王五"));
 lists.add(new User(1, "张三"));
 // 计算这个list中出现 "张三" id的值
 int sum = lists.stream().filter(u -> "张三".equals(u.getName())).mapToInt(u -> u.getId()).sum();

 System.out.println("计算结果:" + sum); 
 // 7
```

