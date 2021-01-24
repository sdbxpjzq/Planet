分布式事务方案没有银弹，根据自己的业务特性选择合适的模式。例如追求强一致性，可以选择AT和XA，存在和外部系统对接，可以选择Saga模式，不能依赖本地事务，可以采用TCC等等。结合各模式的优缺点进行选择。

<img src="https://youpaiyun.zongqilive.cn/image/20210124105012.png" style="zoom:200%;" />

