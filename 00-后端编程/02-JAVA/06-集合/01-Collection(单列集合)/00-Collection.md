单列集合的根接口, 它有两个重要的子接口，分别是`java.util.List`和`java.util.Set`

## List

`List`的特点是元素有序、元素可重复。

`List`接口的主要实现类有`java.util.ArrayList`和`java.util.LinkedList`

## Set

`Set`的特点是元素无序，而且不可重复。

`Set`接口的主要实现类有`java.util.HashSet`和`java.util.TreeSet`。



![](https://pic.superbed.cn/item/5d9e851d451253d178de5d64.jpg)

![](https://pic.superbed.cn/item/5d9e85b7451253d178deeaa4.jpg)



## 常用功能函数

- `public boolean add(E e)`： 把给定的对象添加到当前集合中 。
- `public void clear()` :清空集合中所有的元素。
- `public boolean remove(E e)`: 把给定的对象在当前集合中删除。
- `public boolean contains(E e)`: 判断当前集合中是否包含给定的对象。
- `public boolean isEmpty()`: 判断当前集合是否为空。
- `public int size()`: 返回集合中元素的个数。
- `public Object[] toArray()`: 把集合中的元素，存储到数组中。























