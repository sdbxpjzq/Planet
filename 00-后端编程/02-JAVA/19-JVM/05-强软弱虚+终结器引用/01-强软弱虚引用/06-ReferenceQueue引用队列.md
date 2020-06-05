## **虚引用 和 弱引用, 软引用, 在 GC回收 之前会被保存到 引用队列里** 



创建引用的时候可以指定关联的队列，当gc释放对象内存的时候，会把引用加入到引用队列，如果程序发现某个虚引用已经被加入到引用队列，那么就可以在所引用的对象的内存被回收之前采取必要的行动，相当于通知机制

当关联的引用队列中有数据的时候，意味着引用指向的对内存中的对象被回收。通过这种方式，jvm允许我们在对象被小回收，做一些我们自己想做的事情。

### 代码1

![](https://youpaiyun.zongqilive.cn/image/20200425140726.png)

![](https://youpaiyun.zongqilive.cn/image/20200425141006.png)







### 代码2

![](https://youpaiyun.zongqilive.cn/image/20200425140957.png)

![](https://youpaiyun.zongqilive.cn/image/20200425141013.png)



