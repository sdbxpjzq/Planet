

## 优点和缺点

主要优点: 并发收集、低停顿

几个明显的缺点:

- 对CPU资源敏感(会和服务抢资源);
- 无法处理==浮动垃圾==(在并发清理阶段又产生垃圾，这种浮动垃圾只能等到下一次gc再清理 了);
- 它使用的回收算法-“标记-清除”算法会导致收集结束时会有大量==空间碎片==产生，当然 通过参数`-XX:+UseCMSCompactAtFullCollection` 可以让jvm在执行完标记清除后再做整理
- 执行过程中的不确定性，会存在上一次垃圾回收还没执行完，然后垃圾回收又被触发的情况，特别是在并发标记和并发清理阶段会出现，一边回收，系统一边运行，也许没回收完就再次触发full gc，也就是"concurrent mode failure"，此时会进入stop the world，用serial old垃圾收集器来回收



![](https://youpaiyun.zongqilive.cn/image/20200425150324.png)



![](https://youpaiyun.zongqilive.cn/image/20200609112101.png)

![](https://youpaiyun.zongqilive.cn/image/20200609112116.png)



![](https://youpaiyun.zongqilive.cn/image/20200609112125.png)



![](https://youpaiyun.zongqilive.cn/image/20200609112209.png)

































