## flatMap

作用:把几个小的list转换到一个大的list

![](https://youpaiyun.zongqilive.cn/image/20201018095913.png)



```java
// 初始化一个嵌套集合 [[1, 2], [3, 4, 5]]

ArrayList<List<Integer>> arrayLists = new ArrayList(){{
add(Arrays.asList(1, 2));
add(Arrays.asList(3, 4, 5));

}};

// 使用flatMap 把多个小集合合并成大集合
List<Integer> collect =arrayLists.stream().flatMap(pList ->pList.stream()).collect(Collectors.toList());
System.out.println(collect);

// 输出 [1, 2, 3, 4, 5]
```





接收一个函数作为参数, 将流种的每个值都换成另一个流, 然后把所有流连接成一个流

> flatMap 方法用于映射每个元素到对应的结果，一对多。



```java
String worlds = "The way of the future";
 List<String> list7 = new ArrayList<>();
 list7.add(worlds);
 List<String> list8 = list7.stream().flatMap(str -> Stream.of(str.split(" ")))
   .filter(world -> world.length() > 0).collect(Collectors.toList());
 System.out.println("单词:");
 list8.forEach(System.out::println);
 // 单词:
 // The 
 // way 
 // of 
 // the 
 // future
```



