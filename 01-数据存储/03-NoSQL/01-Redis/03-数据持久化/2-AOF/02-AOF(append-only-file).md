当Redis服务器执行`写命令`的时候，将执行的`写命令`保存到AOF文件中。

AOF 是更新频率最快的, redis会优先使用这种方式恢复数据

![](https://youpaiyun.zongqilive.cn/image/20200613175706.png)



![](https://youpaiyun.zongqilive.cn/image/006tKfTcly1g1a5a23uhhj30hs04qweh.jpg)



## 实现的三个步骤

命令追加

文件写入

文件同步

## 过期策略

- 如果数据库的键已过期，但还没被惰性/定期删除，AOF文件不会因为这个过期键产生任何影响(也就说会保留)，当过期的键被删除了以后，会追加一条DEL命令来显示记录该键被删除了
- 重写AOF文件时，程序会对RDB文件中的键进行检查，**过期的键会被忽略**。



## 





## 优点和缺点

![](https://youpaiyun.zongqilive.cn/image/20200613175957.png)



































