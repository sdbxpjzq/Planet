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

