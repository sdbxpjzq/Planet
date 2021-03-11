我们先定义一个group组概念，这组里面包含了一些分库以及分表

<img src="https://youpaiyun.zongqilive.cn/image/20210310200043.png" style="zoom:150%;" />



![](https://youpaiyun.zongqilive.cn/image/20210310200116.png)

对10进行取模，如果值为【0，1，2，3】就路由到DB_0，【4，5，6】路由到DB_1，【7，8，9】路由到DB_2。现在小伙伴们有没有理解，这样的设计就可以把多一点的数据放到DB_0中，其他2个DB数据量就可以少一点。DB_0承担了4/10的数据量，DB_1承担了3/10的数据量，DB_2也承担了3/10的数据量。整个Group01承担了【0，4000万】的数据量。



## **如何扩容**

扩容的时候再设计一个group02组，定义好此group的数据范围就ok了。

因为是新增的一个group02组，所以就没有什么数据迁移概念，完全是新增的group组，而且这个group组照样就防止了热点，也就是【4000万，5500万】的数据，都均匀分配到三个DB的table_0表中，【5500万～7000万】数据均匀分配到table_1表中。

<img src="https://youpaiyun.zongqilive.cn/image/20210310200423.png" style="zoom:150%;" />



这边隐含了一个关键点，那就是路由key（如：id）的值是非常关键的，要求一定是有序的，自增的，这个就涉及到分布式唯一id的方案



## 具体实现思路

![](https://youpaiyun.zongqilive.cn/image/20210310200557.png)

![](https://youpaiyun.zongqilive.cn/image/20210310200656.png)























