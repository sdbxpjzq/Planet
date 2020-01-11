## copy用法注意

正确使用:

```java
ArrayList<Integer> list = new ArrayList<>();
Collections.addAll(list, 1, 2, 3, 4, 5);

List dest = Arrays.asList(new Object[list.size()]);
Collections.copy(dest, list);
System.out.println(dest);
```



错误写法:

```java
ArrayList<Integer> list = new ArrayList<>();
Collections.addAll(list, 1, 2, 3, 4, 5);

ArrayList<Integer> dest = new ArrayList<>();
Collections.copy(dest, list); // 抛出异常 java.lang.IndexOutOfBoundsException
```