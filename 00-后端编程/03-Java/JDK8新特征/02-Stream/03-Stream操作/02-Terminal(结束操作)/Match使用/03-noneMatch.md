noneMatch 检查是否没有匹配的元素

## `noneMatch`

> noneMatch：Stream 中没有一个元素符合则返回 true

```java
List<Integer> numbers = Arrays.asList(0, 1, 2, 6, 2, 3, 4);
if (numbers.stream().noneMatch(num -> num > 3)) {
  System.out.println("没有一个大于 3");
} else {
  System.out.println("存在 大于3 的值");
}
```

