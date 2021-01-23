NIO 有三大核心组件： `Channel(通道)`，` Buffer(缓冲区)`，`Selector(选择器)`

![](https://youpaiyun.zongqilive.cn/image/20210123140623.png)

1. channel 类似于流，每个 channel 对应一个 buffer缓冲区，buffer 底层就是个数组 
2. channel 会注册到 selector 上，由 selector 根据 channel 读写事件的发生将其交由某个空闲的线程处理 
3. selector 可以对应一个或多个线程 
4. NIO 的 Buffer 和 channel 都是既可以读也可以写







