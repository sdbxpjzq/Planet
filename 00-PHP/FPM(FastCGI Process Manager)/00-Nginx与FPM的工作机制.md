# FPM 
FPM (FastCGI Process Manager)，它是 FastCGI 的实现，任何实现了 FastCGI 协议的 Web Server 都能够与之通信。FPM 之于标准的 FastCGI，也提供了一些增强功能，
FPM 是一个 PHP 进程管理器，包含 master 进程和 worker 进程两种进程：master 进程只有一个，负责监听端口，接收来自 Web Server 的请求，而 worker 进程则一般有多个 (具体数量根据实际需要配置)，每个进程内部都嵌入了一个 PHP 解释器，是 PHP 代码真正执行的地方，下图是我本机上 fpm 的进程情况，1一个 master 进程，3个 worker 进程：
![](https://ws2.sinaimg.cn/large/006tNc79gy1ft4vftmqvhj30k001z0sr.jpg)

从 FPM 接收到请求，到处理完毕，其具体的流程如下：

FPM 的 master 进程接收到请求

master 进程根据配置指派特定的 worker 进程进行请求处理，如果没有可用进程，返回错误，这也是我们配合 Nginx 遇到502错误比较多的原因。

worker 进程处理请求，如果超时，返回504错误

请求处理结束，返回结果
FPM 从接收到处理请求的流程就是这样了，那么 Nginx 又是如何发送请求给 fpm 的呢？这就需要从 Nginx 层面来说明了。

我们知道，Nginx 不仅仅是一个 Web 服务器，也是一个功能强大的 Proxy 服务器，除了进行 http 请求的代理，也可以进行许多其他协议请求的代理，包括本文与 fpm 相关的 fastcgi 协议。为了能够使 Nginx 理解 fastcgi 协议，Nginx 提供了 fastcgi 模块来将 http 请求映射为对应的 fastcgi 请求。

Nginx 的 fastcgi 模块提供了 fastcgi_param 指令来主要处理这些映射关系，下面 Ubuntu 下 Nginx 的一个配置文件，其主要完成的工作是将 Nginx 中的变量翻译成 PHP 中能够理解的变量。
![](https://ws3.sinaimg.cn/large/006tNc79gy1ft4vgxm4hsj30k0098t9a.jpg)

除此之外，非常重要的就是 fastcgi_pass 指令了，这个指令用于指定 fpm 进程监听的地址，Nginx 会把所有的 php 请求翻译成 fastcgi 请求之后再发送到这个地址。下面一个简单的可以工作的 Nginx 配置文件：
![](https://ws4.sinaimg.cn/large/006tNc79gy1ft4vhcxga3j30k006gglo.jpg)

在这个配置文件中，我们新建了一个虚拟主机，监听在 80 端口，Web 根目录为 /home/rf/projects/wordpress。然后我们通过 location 指令，将所有的以 .php 结尾的请求都交给 fastcgi 模块处理，从而把所有的 php 请求都交给了 fpm 处理，从而完成 Nginx 到 fpm 的闭环。