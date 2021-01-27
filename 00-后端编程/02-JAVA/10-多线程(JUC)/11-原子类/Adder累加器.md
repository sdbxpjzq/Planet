![](https://youpaiyun.zongqilive.cn/image/20210126101709.png)

- 高并发下LongAdder比AtomicLong效率高, 本质是空间换时间

  - 使用`AtomicLong`时，在高并发下大量线程会同时去竞争更新同一个原子变量，但是由于同时只有一个线程的`CAS`操作会成功，这就造成了大量线程竞争失败后，会通过无限循环不断进行自旋尝试`CAS`的操作，而这会白白浪费`CPU`资源。
  - LongAdder把不同线程对应到不同的Cell上进行修改, 降低了冲突的概率, 是`多段锁`的理念, 提高了并发性

  

  ![](https://youpaiyun.zongqilive.cn/image/20210126102135.png)

  使用 longAdder 多个线程同时竞争一个原子变量，图示如下

  ![使用 longAdder 多个线程同时竞争一个原子变量，图示如下](https://youpaiyun.zongqilive.cn/image/20210126102150.png)

  

  > `LongAdder` 是把一个变量拆成多份，变为多个变量，有点像 `ConcurrentHashMap` 中 的分段锁，把一个`Long`型拆成一个base变量外加多个`Cell`，每个`Cell`包装了一个`Long`型变量。**这样，在同等并发量的情况下，争夺单个变量更新操作的线程量会减少，这变相地减少了争夺共享资源的并发量。
  > 另外，多个线程在争夺同一个`Cell`原子变量时如果失败了，它并不是在当前`Cell`变量上一直自旋`CAS`重试，而是尝试在其他`Cell`的变量上进行`CAS`尝试，这个改变增加了当前线程重试`CAS`成功的可能性。最后，在获取`LongAdder`当前值时，是把所有`Cell`变量的`value`值累加后再加上`base`返回的。`LongAdder`维护了一个延迟初始化的原子性更新数组（默认情况下`Cell`数组是`null`）和一个基值变量`base`。由于`Cells`占用的内存是相对比较大的，所以一开始并不创建它，而是在需要时创建，也就是惰性加载。

  

  

  

  





























