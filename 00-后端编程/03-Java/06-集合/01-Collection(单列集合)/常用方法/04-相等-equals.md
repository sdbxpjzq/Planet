## 相等-equals

两种情况:

- `List情况`: `值` 和 `顺序 `都一样,  返回true, 否则false
- `Set情况`: `值`一样, 返回true, 与元素顺序无关

`List情况`

```java
ArrayList<Integer> list1 = new ArrayList<>(Arrays.asList(1, 2, 3));
ArrayList<Integer> list2 = new ArrayList<>(Arrays.asList(3, 1, 2));
boolean equals = list2.equals(list1);
System.out.println(equals); // false
```

`Set情况`

```java
HashSet<Integer> set1 = new HashSet<>(Arrays.asList(1, 2, 3));
HashSet<Integer> set2 = new HashSet<>(Arrays.asList(3, 1, 2));
boolean equals1 = set1.equals(set2);
System.out.println(equals1); // true
```