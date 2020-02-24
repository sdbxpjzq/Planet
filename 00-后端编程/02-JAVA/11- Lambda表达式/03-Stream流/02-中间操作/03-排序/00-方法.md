![](https://youpaiyun.zongqilive.cn/image/20200223102739.png)

1、`sorted()` 默认使用自然序排序， 其中的元素必须实现`Comparable` 接口
2、`sorted(Comparator comparator)` ：



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

  





















