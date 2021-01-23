### 堆内存dump

也可以设置内存溢出自动导出dump文件(内存很大的时候，可能会导不出来) 

```
1. -XX:+HeapDumpOnOutOfMemoryError

2. -XX:HeapDumpPath=./ (路径)
```



![](https://youpaiyun.zongqilive.cn/image/20210117171845.png)

可以用jvisualvm命令工具导入该dump文件分析

