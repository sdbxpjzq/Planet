Java8中`forEach`的简单使用

```java
List<String> items = new ArrayList<>();
items.add("A");
items.add("B");
items.add("C");
items.add("D");
items.add("E");
//输出：A,B,C,D,E
items.forEach(item->System.out.println(item));
//输出 : C
items.forEach(item->{
    if("C".equals(item)){
        System.out.println(item);
    }
});

```

## 注意事项

**不能使用`break`和`continue` 和 `return`**



```java
List<String> list = Arrays.asList("123", "45634", "7892", "abch", "sdfhrthj", "mvkd");
list.forEach(e -> {
  if (e.length() >= 5) {
    return;
  }
  System.out.println(e);
});

输出
  123
  7892
  abch
  mvkd
```



