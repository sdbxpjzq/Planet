max(Comparator c)  返回流中最大值

min(Comparator c)  返回流中最小值



```java
 List<String> list13 = Arrays.asList("zhangsan","lisi","wangwu","xuwujing");
 int maxLines = list13.stream().mapToInt(String::length).max().getAsInt();
 int minLines = list13.stream().mapToInt(String::length).min().getAsInt();
 System.out.println("最长字符的长度:" + maxLines+",最短字符的长度:"+minLines);
 //最长字符的长度:8,最短字符的长度:4
```

