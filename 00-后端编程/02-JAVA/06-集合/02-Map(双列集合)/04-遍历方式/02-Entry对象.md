`Map`中存放的是两种对象, 一种称为`key`, 一种称为`value`, 

它们在`Map`中是一一对应关系, 这一对 对象称作`Map`中的一个`Entry(项)`.

`Entry`将`键值对的对应关系`封装成了对象, 即: `键值对对象`

这样在遍历`Map`集合时, 就可以从每一个`Entry对象`中获取对应的键与对应的值.



## 获取所有`Entry`对象

`entrySet()方法`

```java

HashMap<String, Integer> map = new HashMap<>();
map.put("zongqi", 100);
map.put("xiaoli", 400);
map.put("lisi", 300);
// 获取所有的 Entry 对象
Set<Map.Entry<String, Integer>> entrySet = map.entrySet();
```

## 方法介绍

`public k getKey()` : 获取`Entry`对象的键

`public v getValue()` : 获取`Entry`对象中的值

![](https://pic.superbed.cn/item/5da28a2f9dc6d64c09db1a43.jpg)

```java
public static void main(String[] args) {
  HashMap<String, Integer> map = new HashMap<>();
  map.put("zongqi", 100);
  map.put("xiaoli", 400);
  map.put("lisi", 300);
  // 获取所有的 Entry对象
  Set<Map.Entry<String, Integer>> entrySet = map.entrySet();

  Iterator<Map.Entry<String, Integer>> iterator = entrySet.iterator();
  while (iterator.hasNext()) {
    Map.Entry<String, Integer> entry = iterator.next();
    entry.getKey();
    entry.getValue();
  }
}

```































