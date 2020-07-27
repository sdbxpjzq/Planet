其实也是对 HashMap 做的方法做了一层包装，里面使用对象锁来保证多线程场景下，操作安全，本质也是对 HashMap 进行全表锁！用`Collections.synchronizedMap`方法，在竞争激烈的多线程环境下性能依然也非常差，所以不推荐使用！







![](https://youpaiyun.zongqilive.cn/image/20200714192556.png)

