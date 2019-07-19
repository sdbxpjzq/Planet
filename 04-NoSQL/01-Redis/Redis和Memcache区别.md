![](http://ww1.sinaimg.cn/large/006tNc79ly1g3zfbuk038j31a60gqdh2.jpg)



## Memcached的优点

高效的内存管理-减少内存碎片

内存管理中一个令人头疼的问题就是内存碎片管理。操作系统、虚拟机垃圾回收在这方面想了许多方法：压缩、复制等。

Memcached使用了一个非常简单的方法——**固定空间分配**。

Memcached将内存空间分为一组slab，每个slab里又包含一组chunk，同一个slab里的每个chunk的大小是固定的，

拥有相同大小chunk的slab被组织在一起，叫作slab_class。



**存储数据时根据数据的Size大小，寻找一个大于Size的最小chunk将数据写入**。

这种内存管理方式避免了内存碎片管理的问题，内存的分配和释放都是以chunk为单位的。

和其它缓存一样，Memcached采用LRU算法释放最近最久未被访问的数据占用的空间，

释放的chunk被标记为未用，等待下一个合适大小的数据写入。

![Zb5Nh4.png](https://s2.ax1x.com/2019/07/16/Zb5Nh4.png)







