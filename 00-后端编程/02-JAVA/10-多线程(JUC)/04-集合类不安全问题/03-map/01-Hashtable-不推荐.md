Hashtable 几乎所有的添加、删除、查询方法都加了`synchronized`同步锁.

相当于给整个哈希表加了一把大锁，多线程访问时候，只要有一个线程访问或操作该对象，那其他线程只能阻塞等待需要的锁被释放，在竞争激烈的多线程场景中性能就会非常差，**所以 Hashtable 不推荐使用！**

![](https://youpaiyun.zongqilive.cn/image/20200714192329.png)

