## reduce

> reduce将流中的元素组合起来



```java
// JDK8 之前求和
int sum =0;
for (int i : integerList) {
  sum += i;
}
// stream
int sum = integerList.stream().reduce(0,(a, b) ->(a + b));
```

reduce接受两个参数，一个初始值这里是0，一个 `BinaryOperator<T>accumulator`
来将两个元素结合起来产生一个新值，

另外reduce方法还有一个没有初始化值的重载方法







> reduce 主要作用是把 Stream 元素组合起来进行操作。

![](https://youpaiyun.zongqilive.cn/image/20200223121454.png)



```java
 示例一：字符串连接
String concat = Stream.of("A", "B", "C", "D").reduce("", String::concat);
System.out.println("字符串拼接:" + concat);

示例二：得到最小值
double minValue = Stream.of(-4.0, 1.0, 3.0, -2.0).reduce(Double.MAX_VALUE, Double::min);
System.out.println("最小值:" + minValue);
//最小值:-4.0

示例三：求和
// 求和, 无起始值
int sumValue = Stream.of(1, 2, 3, 4).reduce(Integer::sum).get();
System.out.println("有无起始值求和:" + sumValue);
// 求和, 有起始值
sumValue = Stream.of(1, 2, 3, 4).reduce(1, Integer::sum);
System.out.println("有起始值求和:" + sumValue);
// 有无起始值求和:10
// 有起始值求和:11

示例四：过滤拼接
concat = Stream.of("a", "B", "c", "D", "e", "F").filter(x -> x.compareTo("Z") > 0).reduce("", String::concat);
System.out.println("过滤和字符串连接:" + concat);
 //过滤和字符串连接:ace


```





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







