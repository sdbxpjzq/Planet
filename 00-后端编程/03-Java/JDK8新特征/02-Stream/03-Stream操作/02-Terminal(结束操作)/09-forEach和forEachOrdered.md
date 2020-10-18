## forEach

![](https://youpaiyun.zongqilive.cn/image/5e099ec176085c3289ae4f4e.jpg)





## forEachOrdered

如果对于有序流按照它的`encounter order`顺序执行，你可以使用`forEachOrdered`方法。



## 两者区别

**@注意:**

1. 在串行的流中，forEach和forEachOrdered遍历输出的结果一样。

2. 在并行的流中，forEach每次输出的结果不一致。

3. 在并行的流中，forEachOrdered每次输出的结果一致。





