![](https://youpaiyun.zongqilive.cn/image/20200613175039.png)



![](https://youpaiyun.zongqilive.cn/image/20200613175219.png)









## 触发生成RDB文件

1. 满足配置规则,会自动触发
2. 执行 `flushall`命令
3. 退出redis

### 同步 `save` 模式

- `SAVE`会**阻塞**Redis服务器进程，服务器不能接收任何请求，直到RDB文件创建完毕为止。

### 异步 `bgsave` 模式

- `BGSAVE`创建出一个**子进程**，由子进程来负责创建RDB文件，服务器进程可以继续接收请求。







## 恢复

Redis服务器在启动的时候，如果发现有RDB文件，就会**自动**载入RDB文件(不需要人工干预)

- 服务器在载入RDB文件期间，会处于阻塞状态，直到载入工作完成。



## 过期策略

- 执行`SAVE`或者`BGSAVE`命令创建出的RDB文件，程序会对数据库中的过期键检查，**已过期的键不会保存在RDB文件中**。
- 载入RDB文件时，程序同样会对RDB文件中的键进行检查，**过期的键会被忽略**。



## 优点和缺点

![](https://youpaiyun.zongqilive.cn/image/20200613175448.png)





































