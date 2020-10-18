## averagingInt

计算流种的Integer属性 平均值



```java
double average = menu.stream().collect(averagingInt(Dish::getCalories));
```

如果数据类型为double、long，则通过averagingDouble、averagingLong方法进行求平均