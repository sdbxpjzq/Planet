![](https://youpaiyun.zongqilive.cn/image/20210123144119.png)

netty 的线程模型 基于上边的

netty 一主多从的 线程模型, 主要是这个, 需要绑定一个端口

netty 多主多从的 线程模型, 同时要绑定多个端口





<img src="https://youpaiyun.zongqilive.cn/image/20210123144422.png" style="zoom:150%;" />





- **Acceptor**：请求接收者，在实践时其职责类似服务器，并不真正负责连接请求的建立，而只将其请求委托 Main Reactor 线程池来实现，起到一个转发的作用。
- **Main Reactor**：主 Reactor 线程组，主要负责连接事件，并将 IO 读写请求转发到 SubReactor 线程池。当然在一些需要对客户端进行权限控制等场景下，权限校验的职责可以放到 Main Reactor 线程池，即 Main Reactor 也可以注册通道的读写事件，读取客户端权限校验相关的数据包，执行权限验证，权限验证通过后再将2通道注册到 IO 线程。
- **Sub Reactor**：Main Reactor 通常监听客户端连接后会将通道的读写转发到 Sub Reactor 线程池中一个线程(负载均衡)，负责数据的读写。在 NIO 中 通常注册通道的读(OP_READ)、写事件(OP_WRITE)。







