## 通过函数生成 提供了iterate和generate两个静态方法从函数中生成流

#### iterate

```java
Stream.iterate(2, n -> n + 2).limit(5).forEach(x -> System.out.print(x + " "));
```

iterate方法接受两个参数，第一个为`初始化值`，第二个为进行的`函数操作`，因为iterator生成的流为`无限流`，通过limit方法对流进行了截断，只生成5个偶数

#### generator

```java
Stream<Double> stream =Stream.generate(Math::random).limit(5);
```

generate方法接受一个参数，方法参数类型为Supplier ，由它为流提供值。generate生成的流也是`无限流`，因此通过limit对流进行了截断

