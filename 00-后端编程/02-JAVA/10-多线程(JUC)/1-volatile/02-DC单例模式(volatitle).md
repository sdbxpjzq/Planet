![](https://youpaiyun.zongqilive.cn/image/20200421170323.png)

```
这个地方的synchronized起到了同步作用。对于其内部就相当于单线程操作了，是不会影响其内部的指令重排的。但是使用volatile可以禁止指令重排，此处是volatile的写操作，因此会保证其之间的所有指令一定会在volatile写操作之前完成，那么instance = new SingleTon()这个复合操作指令一定是对象创建完成再进行赋值
```



## volatile分析

主要是禁止指令重排

![](https://youpaiyun.zongqilive.cn/image/20200421170352.png)







