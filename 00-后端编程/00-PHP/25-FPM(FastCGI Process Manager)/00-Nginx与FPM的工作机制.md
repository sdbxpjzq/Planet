# FPM 
FPM (FastCGI Process Manager)，它是 FastCGI 的实现，任何实现了 FastCGI 协议的 Web Server 都能够与之通信。FPM 之于标准的 FastCGI，也提供了一些增强功能，
FPM 是一个 PHP 进程管理器，包含 master 进程和 worker 进程两种进程：master 进程只有一个，负责监听端口，接收来自 Web Server 的请求，而 worker 进程则一般有多个 (具体数量根据实际需要配置)，每个进程内部都嵌入了一个 PHP 解释器，是 PHP 代码真正执行的地方，下图是我本机上 fpm 的进程情况，1一个 master 进程，3个 worker 进程：

![](https://youpaiyun.zongqilive.cn/image/006tNc79gy1ft4vftmqvhj30k001z0sr.jpg)

从 FPM 接收到请求，到处理完毕，其具体的流程如下：

FPM 的 master 进程接收到请求

master 进程根据配置指派特定的 worker 进程进行请求处理，如果没有可用进程，返回错误，这也是我们配合 Nginx 遇到502错误比较多的原因。

worker 进程处理请求，如果超时，返回504错误



 worker正常执行max_requests个请求正常退出.

对于单个worker进程，是串行执行接收到的每个请求。这种简单的实现就导致有多少个worker最多同时处理的请求数量就有多少。这也是不能高并发的主要原因。

## master如何获取worker的运行信息?

是通过共享内存来通信的



请求处理结束，返回结果
FPM 从接收到处理请求的流程就是这样了，那么 Nginx 又是如何发送请求给 fpm 的呢？这就需要从 Nginx 层面来说明了。

我们知道，Nginx 不仅仅是一个 Web 服务器，也是一个功能强大的 Proxy 服务器，除了进行 http 请求的代理，也可以进行许多其他协议请求的代理，包括本文与 fpm 相关的 fastcgi 协议。为了能够使 Nginx 理解 fastcgi 协议，Nginx 提供了 fastcgi 模块来将 http 请求映射为对应的 fastcgi 请求。

Nginx 的 fastcgi 模块提供了 fastcgi_param 指令来主要处理这些映射关系，下面 Ubuntu 下 Nginx 的一个配置文件，其主要完成的工作是将 Nginx 中的变量翻译成 PHP 中能够理解的变量。
![](https://youpaiyun.zongqilive.cn/image/006tNc79gy1ft4vgxm4hsj30k0098t9a.jpg)

除此之外，非常重要的就是 `fastcgi_pass` 指令了，这个指令用于指定 fpm 进程监听的地址，Nginx 会把所有的 php 请求翻译成 fastcgi 请求之后再发送到这个地址。下面一个简单的可以工作的 Nginx 配置文件：
![](https://youpaiyun.zongqilive.cn/image/006tNc79gy1ft4vhcxga3j30k006gglo.jpg)

在这个配置文件中，我们新建了一个虚拟主机，监听在 80 端口，Web 根目录为 /home/rf/projects/wordpress。然后我们通过 location 指令，将所有的以 .php 结尾的请求都交给 fastcgi 模块处理，从而把所有的 php 请求都交给了 fpm 处理，从而完成 Nginx 到 fpm 的闭环。

## **Nginx 与 php-fpm 通信机制**

当我们访问一个网站（如 `www.test.com`）的时候，处理流程是这样的：

```
www.test.com
        |
      Nginx
        |
路由到 www.test.com/index.php
        |
加载 nginx 的 fast-cgi 模块
        |
fast-cgi 监听 127.0.0.1:9000 地址
        |
www.test.com/index.php 请求到达 127.0.0.1:9000
        |
     php-fpm监听127.0.0.1:9000
      |
     php-fpm接收到请求, 启动worker进程处理请求
      |
    php-fpm处理完请求, 返回nginx
     |
   nginx将结果通过http返回给浏览器  
```

## 通信方式

- ` tcp socket`
- `unix socket`

### tcp socket

tcp socket 的优点是可以跨服务器，当 nginx 和 php-fpm 不在同一台机器上时，只能使用这种方式。

### unix socket

Unix socket 又叫 IPC(inter-process communication 进程间通信) socket，用于实现同一主机上的进程间通信，这种方式需要在 nginx配置文件中填写 php-fpm 的 socket 文件位置。



nginx文件配置:

```
#当请求网站下 php 文件的时候，反向代理到 php-fpm
 location ~ \.php$ {
  include /usr/local/etc/nginx/fastcgi.conf; #加载 nginx 的 fastcgi 模块
  fastcgi_intercept_errors on;
  fastcgi_pass 127.0.0.1:9000; # tcp 方式，php-fpm 监听的 IP 地址和端口
  # fasrcgi_pass /usr/run/php-fpm.sock # unix socket 连接方式
 }
```



### 二者的不同

由于 Unix socket 不需要经过网络协议栈，不需要打包拆包、计算校验和、维护序号和应答等，只是将应用层数据从一个进程拷贝到另一个进程。所以其效率比 tcp socket 的方式要高，可减少不必要的 tcp 开销。不过，unix socket 高并发时不稳定，连接数爆发时，会产生大量的长时缓存，在没有面向连接协议的支撑下，大数据包可能会直接出错不返回异常。而 tcp 这样的面向连接的协议，可以更好的保证通信的正确性和完整性。

### 在应用中的选择

如果是在同一台服务器上运行的 nginx 和 php-fpm，且并发量不高（不超过1000），选择unix socket，以提高 nginx 和 php-fpm 的通信效率。 

如果是面临高并发业务，则考虑选择使用更可靠的 tcp socket，以负载均衡、内核优化等运维手段维持效率。



















