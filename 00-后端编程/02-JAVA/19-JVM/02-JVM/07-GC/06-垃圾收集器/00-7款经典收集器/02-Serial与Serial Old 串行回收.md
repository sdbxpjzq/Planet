## 串行垃圾回收器（Serial）

`-XX:+UserSerialGC `, 表名新生代使用`Serial GC`, 同时老年代使用`Serial Old GC`

为单线程换进该设计且只是用过一个线程进行垃圾回收，会暂停所有的用户线程，不适合服务器环境



![](https://youpaiyun.zongqilive.cn/image/20200608185151.png)



![](https://youpaiyun.zongqilive.cn/image/20200608185229.png)

![](https://youpaiyun.zongqilive.cn/image/20200608185256.png)

















