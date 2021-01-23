## jstat（统计信息监控工具）

用于监视虚拟机各种运行状态信息的工具，可以显示本地或者远程的虚拟机进程类装载、内存、GC、JIT等运行数据，在没有GUI图像界面的服务器上，主要就是用它在运行期定位性能问题。

<img src="https://youpaiyun.zongqilive.cn/image/20210118100102.png" style="zoom: 150%;" />



使用格式 ：`jstat [option vmid [interval [s|ms] [count]] ]`



``` 
// 表示每5秒钟查看一次 <pid> 虚拟机进程的GC情况，一共查询10次
jstat -gc <pid> 5s 10
```



```
S0C:第一个幸存区的大小 
S1C:第二个幸存区的大小 
S0U:第一个幸存区的使用大小 
S1U:第二个幸存区的使用大小 
EC:伊甸园区的大小 
EU:伊甸园区的使用大小 
OC:老年代大小
OU:老年代使用大小 
MC:方法区大小(元空间) 
MU:方法区使用大小 
CCSC:压缩类空间大小 
CCSU:压缩类空间使用大小 
YGC:年轻代垃圾回收次数 
YGCT:年轻代垃圾回收消耗时间，单位s
```





![](https://youpaiyun.zongqilive.cn/image/20200427101027.png)









