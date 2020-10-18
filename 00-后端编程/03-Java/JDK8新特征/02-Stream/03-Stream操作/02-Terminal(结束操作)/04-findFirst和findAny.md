## findFirst

findFirst 返回第一个元素

```java
List<Integer> integerList =Arrays.asList(1,2,3,4, 5);
Optional<Integer> result = integerList.stream().filter(i -> i >3).findFirst();
```

通过findFirst方法查找到第一个大于三的元素并打印





## findAny

findAny 返回当前流种的任意元素

```java
List<Integer> integerList =Arrays.asList(1, 2, 3, 4, 5);
Optional<Integer> result = integerList.stream().filter(i -> i >3).findAny();
```

通过findAny方法查找到其中一个大于三的元素并打印，因为内部进行优化的原因，当找到第一个满足大于三的元素时就结束，该方法结果和findFirst方法结果一样。提供findAny方法是为了更好的利用并行流，findFirst方法在并行上限制更多 (可以参考并行流)