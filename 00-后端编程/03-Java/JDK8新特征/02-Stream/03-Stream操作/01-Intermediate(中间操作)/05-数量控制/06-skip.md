## skip

> 跳过前 n 个元素, 若流种元素不足n个, 则返回一个空流, 与`limit(n)`互补

```java
List<User> list9 = new ArrayList<User>();
 for (int i = 1; i < 4; i++) {
  User user = new User(i, "pancm" + i);
  list9.add(user);
 }
 System.out.println("截取之前的数据:");
 // 取前3条数据，但是扔掉了前面的2条，可以理解为拿到的数据为 2<=i<3 (i 是数值下标)
 List<String> list10 = list9.stream().map(User::getName).limit(3).skip(2).collect(Collectors.toList());
 System.out.println("截取之后的数据:" + list10);
 //  截取之前的数据:
 //  姓名:pancm1
 //  姓名:pancm2
 //  姓名:pancm3
 //  截取之后的数据:[pancm3]
```



![](https://youpaiyun.zongqilive.cn/image/5e09ab5076085c3289b05d52.jpg)

![](https://youpaiyun.zongqilive.cn/image/5e09ab6176085c3289b06002.jpg)

