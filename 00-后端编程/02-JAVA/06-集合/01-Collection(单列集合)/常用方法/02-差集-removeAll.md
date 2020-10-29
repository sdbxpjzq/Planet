## 差集-removeAll

`public boolean removeAll(E c)`

```java
ArrayList<Integer> list1 = new ArrayList<>(Arrays.asList(2));
ArrayList<Integer> list2 = new ArrayList<>(Arrays.asList(3, 1, 2));

// 会修改 list2的值
list2.removeAll(list1);
System.out.println(list2); // [3, 1]
```