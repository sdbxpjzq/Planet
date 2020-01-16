## Arrays.asList(T... a)

转换成固定长度的`List集合`

返回的`List`集合, 既不是`ArrayList`实例, 也不是`Vevtor`实例,而是一个固定固定长度的`List`集合 

```java
List<Integer> list2 = Arrays.asList(1, 2, 3);
System.out.println(list2); // [1, 2, 3]
```

>  注意事项:
>
>  一句话：直接使用 Arrays.asList() 方式转将数组转换为的集合，是不可被更改(add, remove都不能使用)
>
>  ```java
>  list2.remove(0); // 抛出异常 java.lang.UnsupportedOperationException
>  ```
>
>  解决办法:
>
>  ```java
>  ArrayList<Integer> list = new ArrayList<>(Arrays.asList(3, 1, 2));
>  list.remove(0);
>  System.out.println(list); // [1,2]
>  ```
>
>  



## Collections.singletonList()

`Collections.singletonList(something)`是不可变的，而`Arrays.asList(something)`是一个固定大小的List表示的数组，其中列表和数组加入堆中。

`Arrays.asList(something)`允许对其进行非结构更改，这将同时反映到列表和连接数组中。它抛出`UnsupportedOperationException`来添加、删除元素，尽管您可以为特定索引设置元素。

对`Collections.singletonList(something)`返回的列表所做的任何更改都将导致`UnsupportedOperationException`。

另外，由`Collections.singletonList(something)`返回的列表的容量始终是`1`，而不像`Arrays.asList(something)`，后者的容量将是`备份数组的大小`。

