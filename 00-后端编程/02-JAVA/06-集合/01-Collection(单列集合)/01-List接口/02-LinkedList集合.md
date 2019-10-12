`java.util.LinkedList`的数据存储结构是`链表结构`

**增删快, 查找慢**

> `LinkedList`是一个双向链表

![](https://pic.superbed.cn/item/5da124dc451253d178592049.jpg)

`LinkedList`提供了大量操作首尾的操作方法

![](https://pic.superbed.cn/item/5da12517451253d1785942b3.jpg)



```java
public static void main(String[] args) throws ParseException {
  LinkedList<String> strings = new LinkedList<>();
  strings.add("hello");
  strings.add("world");
  print(strings);

}

public static void print(Collection<?> list) {
  Iterator<?> iterator = list.iterator();
  while (iterator.hasNext()) {
    // 取出的都是Object, 可以接收任意类型的数据
    Object s = iterator.next();
    System.out.println(s);
  }
}
```























































