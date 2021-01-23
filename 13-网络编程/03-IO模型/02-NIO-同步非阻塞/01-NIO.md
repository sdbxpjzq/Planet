## 同步非阻塞

服务器实现模式为`一个线程可以处理多个请求`, 客户端发送的连接请求都会注册到`多路复用器selector`上，多路复用 器轮询到连接有IO请求就进行处理

I/O多路复用底层一般用的Linux API（select，poll，epoll）来实现

![](https://youpaiyun.zongqilive.cn/image/20210123140419.png)

![](https://youpaiyun.zongqilive.cn/image/20210123140500.png)

![](https://youpaiyun.zongqilive.cn/image/20210123142731.png)

![](https://youpaiyun.zongqilive.cn/image/20210123142850.png)



## 总结

NIO模型的selector 就像一个大总管，负责监听各种IO事件，然后转交给后端线程去处理

NIO把等待客户端操作的事情交给了大总管 selector，selector 负责轮询所有已注册的客户端，发现有事件发生了才转交给后端线程处 理，后端线程不需要做任何阻塞等待，直接处理客户端事件的数据即可，处理完马上结束，或返回线程池供其他客户端事件继续使用。还 有就是 channel 的读写是非阻塞的。

























