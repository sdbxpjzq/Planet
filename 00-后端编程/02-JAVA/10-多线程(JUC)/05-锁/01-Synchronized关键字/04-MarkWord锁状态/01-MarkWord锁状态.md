==synchronized锁是存在对象头中的==

锁的状态可以从`无锁状态`->`偏向锁`->`轻量级锁`->`重量级锁`，随着竞争情况逐渐升级，但是不能降级。

![](https://youpaiyun.zongqilive.cn/image/20200709192414.png)

![](https://youpaiyun.zongqilive.cn/image/20200710165501.png)

## 锁的优缺点对比

![](https://youpaiyun.zongqilive.cn/image/20200712102254.png)







## 锁升级过程图



![](https://youpaiyun.zongqilive.cn/image/Java Synchronized整体原理.jpg)



![](https://youpaiyun.zongqilive.cn/image/20200711164207.png)



![](https://youpaiyun.zongqilive.cn/image/20200712101451.png)




















