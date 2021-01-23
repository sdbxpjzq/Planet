相比Java spi，dubbo spi做了一定的改进和优化。

- java spi 会一次性加载所有扩展点实现，如果有扩展实现则初始化很耗时，如果没用上也加载，则浪费资源。
- 增加了对扩展IOC和AOP的支持，一个扩展可以直接setter注入其它扩展。在java spi中，会一次把所有相关的扩展实现类全部初始化，用户直接调用即可。在dubbo spi中，只是加载配置文件中的类，并分成不同的种类缓存在内存中，而不会立即全部初始化，在性能上有更好的表现。



在dubbo启动的时候，会默认扫描一下三个目录的配置文件:

- META-INF/services/目录：用于兼容jdk spi
- META-INF/dubbo/目录：存放用户自定义spi配置文件
- META-INF/dubbo/internal/目录：存放dubbo内部使用的spi配置文件



dubbo spi配置文件是以kv的形式，例如：

k是扩展名，v是具体的扩展实现类。

```
dubbo=org.apache.dubbo.rpc.protocol.dubbo.DubboProtocol
```









Dubbo设计了ExtensionLoader类，其提供的功能比JDK更为强大。



