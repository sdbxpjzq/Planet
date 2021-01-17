```
1. -XX:+UseConcMarkSweepGC:启用cms
2. -XX:ConcGCThreads:并发的GC线程数
3. -XX:+UseCMSCompactAtFullCollection:FullGC之后做压缩整理(减少碎片)
4. -XX:CMSFullGCsBeforeCompaction:多少次FullGC之后压缩一次，默认是0，代表每次 FullGC后都会压缩一次
5. -XX:CMSInitiatingOccupancyFraction: 当老年代使用达到该比例时会触发FullGC(默认 是92，这是百分比)
6. -XX:+UseCMSInitiatingOccupancyOnly:只使用设定的回收阈值(- XX:CMSInitiatingOccupancyFraction设定的值)，如果不指定，JVM仅在第一次使用设定 值，后续则会自动调整
7. -XX:+CMSScavengeBeforeRemark:在CMS GC前启动一次minor gc，目的在于减少 老年代对年轻代的引用，降低CMS GC的标记阶段时的开销，一般CMS的GC耗时 80%都在 remark阶段
```

![](https://youpaiyun.zongqilive.cn/image/20200609145055.png)

![](https://youpaiyun.zongqilive.cn/image/20200609145106.png)





