## sorted

1、`sorted()` 默认使用升序， 其中的元素必须实现`Comparable` 接口
2、`sorted(Comparator comparator)` ：



```java
 //普通的排序取值
 List<User> list11 = list9.stream().sorted((u1, u2) -> u1.getName().compareTo(u2.getName())).limit(3)
   .collect(Collectors.toList());
 System.out.println("排序之后的数据:" + list11);
 //优化排序取值
 List<User> list12 = list9.stream().limit(3).sorted((u1, u2) -> u1.getName().compareTo(u2.getName()))
   .collect(Collectors.toList());
```







示例:

- 下面代码以自然序排序一个list

  ```java
  list.stream().sorted()
  ```

- 自然序逆序元素，使用`Comparator` 提供的`reverseOrder()` 方法

  ```java
  list.stream().sorted(Comparator.reverseOrder()) 
  ```

- 使用`Comparator` 来排序一个list

  ```java
  list.stream().sorted(Comparator.comparing(Student::getAge))
  ```

- 把上面的元素逆序

  ```java
  list.stream().sorted(Comparator.comparing(Student::getAge).reversed()) 
  ```
























