## 方式1_ 通过集合

所有的`Collection`集合都可以通过`stream()`方法获取流

![](https://pic.superbed.cn/item/5e099bd476085c3289add223.jpg)



![](https://pic.superbed.cn/item/5e099bf976085c3289add8d9.jpg)



```java
Collection<String> stringList = new ArrayList<>();
Stream<String> stringStream = stringList.parallelStream();

```





## 方式2_Stream的of()方法

`Stream`接口的静态方法`of()`可以获取数组对应的流.

数组转换成Stream流:

![](https://pic.superbed.cn/item/5e099c3176085c3289ade267.jpg)

## 方式3_Arrays的stream()方法

![](https://pic.superbed.cn/item/5e0dd52f76085c3289662614.jpg)



## 方式4_创建无限流

![](https://pic.superbed.cn/item/5e0dd56976085c3289662ce8.jpg)

![](https://pic.superbed.cn/item/5e0dd57676085c3289662e49.jpg)

















































