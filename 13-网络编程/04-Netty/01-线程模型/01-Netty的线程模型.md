

Netty 的线程模型是基于主从多 Reactor 模型

![](https://youpaiyun.zongqilive.cn/image/20210123144911.png)



![](https://youpaiyun.zongqilive.cn/image/20210123151526.png)

![](https://youpaiyun.zongqilive.cn/image/20210123145037.png)

模型解释：

1) Netty 抽象出两组线程池BossGroup和WorkerGroup，BossGroup专门负责接收客户端的连接, WorkerGroup专门负责网络的读写

2) BossGroup和WorkerGroup类型都是NioEventLoopGroup

3) NioEventLoopGroup 相当于一个事件循环线程组, 这个组中含有多个事件循环线程 ， 每一个事件 循环线程是NioEventLoop

4) 每个NioEventLoop都有一个selector , 用于监听注册在其上的socketChannel的网络通讯

5) 每个Boss NioEventLoop线程内部循环执行的步骤有 3 步 处理accept事件 , 

- 与client 建立连接 , 生成 NioSocketChannel 
- 将NioSocketChannel注册到某个worker NIOEventLoop上的selector 
- 处理任务队列的任务 ， 即runAllTasks

6) 每个worker NIOEventLoop线程循环执行的步骤 

- 轮询注册到自己selector上的所有NioSocketChannel 的read, write事件 
- 处理 I/O 事件， 即read , write 事件， 在对应NioSocketChannel 处理业务 
- runAllTasks处理任务队列TaskQueue的任务 ，一些耗时的业务处理一般可以放入 TaskQueue中慢慢处理，这样不影响数据在 pipeline 中的流动处理

7) 每个worker NIOEventLoop处理NioSocketChannel业务时，会使用 pipeline (管道)，管道中维护 了很多 handler 处理器用来处理 channel 中的数据



## 总结

1. Netty 的线程模型基于主从多 Reactor 模型。通常由一个线程负责处理 OP_ACCEPT 事件，拥有 CPU 核数的两倍的IO线程处理读写事件。
2. 一个通道的 IO 操作会绑定在一个 IO 线程中，而一个 IO 线程可以注册多个通道。
3. 在一个网络通信中通常会包含网络数据读写，编码、解码、业务处理。默认情况下编码、解码等操作会在 IO 线程中运行，但也可以指定其他线程池。
4. 通常业务处理会单独开启业务线程池，但也可以进一步细化，例如心跳包可以直接在IO线程中处理，而需要再转发给业务线程池，避免线程切换。
5. 在一个 IO 线程中所有通道的事件是串行处理的。





































