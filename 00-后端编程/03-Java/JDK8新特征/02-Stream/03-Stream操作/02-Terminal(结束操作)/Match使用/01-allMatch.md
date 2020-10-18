allMatch 检查是否匹配所有元素

## `allMatch`

> allMatch：Stream 中全部元素符合则返回 true ;

```java
List<Integer> numbers = Arrays.asList(6, 2, 3, 4, 5, 6, 7, 8, 9);
if (numbers.stream().allMatch(num -> num > 3)) {
  System.out.println("值都大于 3");
}else {
  System.out.println("存在有小于 3 的值");
}
```

