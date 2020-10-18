anyMatch 检查是否至少匹配一个元素

## `anyMatch`

> anyMatch：Stream 中只要有一个元素符合则返回 true;

```java
List<Integer> numbers = Arrays.asList(6, 2, 3, 4, 5, 6, 7, 8, 9);
if (numbers.stream().anyMatch(num -> num > 3)) {
  System.out.println("有一个大于3 的值");
}else {
  System.out.println("不存在 大于3 的值");
}
```