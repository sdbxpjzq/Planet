noneMatch 检查是否没有匹配的元素

## `noneMatch`

```java
List<Integer> numbers = Arrays.asList(0, 1, 2, 6, 2, 3, 4);
if (numbers.stream().noneMatch(num -> num > 3)) {
  System.out.println("值都 小于3");
} else {
  System.out.println("存在 大于3 的值");
}
```

