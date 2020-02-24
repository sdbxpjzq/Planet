

![](https://youpaiyun.zongqilive.cn/image/20200223105738.png)



## 示例1

```java
List<Integer> l = Stream.of('a','b','c')
  .map( c -> c.hashCode())
  .collect(Collectors.toList());
System.out.println(l); //[97, 98, 99]
```

## 示例2

```java
public static void main(String[] args) {
  // 获取一个String类型的Stream 流
  Stream<String> stream1  = Stream.of("1", "2", "3");
  // 转成 Integer 类型
  Stream<Integer> stream2 = stream1.map(s -> {
    return Interge.parseInt(s);
  });
}
```















