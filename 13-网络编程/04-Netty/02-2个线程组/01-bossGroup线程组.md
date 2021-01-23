bossGroup线程组只有一个线程处理客户端连接请求，连接完成后将完成三次握手的SocketChannel连接`分发给workerGroup`处理读写请求，



```java
public class NettyServer {
  public static void main(String[] args) throws Exception {
    EventLoopGroup bossGroup = new NioEventLoopGroup(1);
    EventLoopGroup workerGroup = new NioEventLoopGroup(8);
    try {
      ServerBootstrap bootstrap = new ServerBootstrap();
      bootstrap.group(bossGroup, workerGroup)
        .channel(NioServerSocketChannel.class)
        .option(ChannelOption.SO_BACKLOG, 128)
        .childOption(ChannelOption.SO_KEEPALIVE, true)
        .childHandler(new ChannelInitializer<SocketChannel>() {
          @Override
          protected void initChannel(SocketChannel ch) throws Exception {
            ch.pipeline().addLast(new NettyServerHandler());
          }
        });
      ChannelFuture channelFuture = bootstrap.bind(9999).sync();
      System.out.println("服务端准备就绪");
      channelFuture.channel().closeFuture().sync();
    } catch (Exception ex) {
      System.out.println(ex.getMessage());
    } finally {
      bossGroup.shutdownGracefully();
      workerGroup.shutdownGracefully();
    }
  }
}
```



