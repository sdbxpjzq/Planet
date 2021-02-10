## subList的注意事项

subList返回的是原集合的快照



1. 修改原集合元素的值，会影响子集合
2. 修改原集合的结构，会引起`ConcurrentModificationException`异常
3. 修改子集合元素的值，会影响原集合
4. 修改子集合的结构，会影响原集合



![](https://youpaiyun.zongqilive.cn/image/20210209171302.png)

![](https://youpaiyun.zongqilive.cn/image/20210209171312.png)

![](https://youpaiyun.zongqilive.cn/image/20210209171351.png)

![](https://youpaiyun.zongqilive.cn/image/20210209171406.png)







