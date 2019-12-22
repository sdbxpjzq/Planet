`java.util.Arrays`是一个与`数组`相关的工具类, 里边提供了大量`静态方法`, 用来实现数组常见的操作.



## Arrays.asList(T... a)

转换成`List集合`

```java
List<Integer> list2 = Arrays.asList(1, 2, 3);
System.out.println(list2); // [1, 2, 3]
```

>  注意事项:
>
>  一句话：直接使用 Arrays.asList() 方式转将数组转换为的集合，是不可被更改(add, remove都不能使用)
>
> ```java
> list2.remove(0); // 抛出异常 java.lang.UnsupportedOperationException
> ```
>
> 解决办法:
>
> ```java
> ArrayList<Integer> list = new ArrayList<>(Arrays.asList(3, 1, 2));
> list.remove(0);
> System.out.println(list); // [1,2]
> ```
>
> 





## Arrays.sort(数组)

数值:  默认按照从小到大

字符串: 默认按照字母升序

自定义类型: 需要有`Comparable`或`Comparator`接口的支持