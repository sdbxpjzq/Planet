![](https://youpaiyun.zongqilive.cn/image/20200223121454.png)



假设我们对一个集合中的值进行求和

`reduce`接受两个参数:

- 一个初始值这里是0
- 一个 `BinaryOperatoraccumulator`
  来将两个元素结合起来产生一个新值，

```java
List<Integer> numbers = Arrays.asList(0, 1, 2, 6, 2, 3, 4);
Integer sum = numbers.stream().reduce(0, (a, b) -> a + b);
System.out.println(sum);
```







