Seata 支持四种工作模式：

**2.1 AT（Auto Transaction）**

AT模式是Seata默认的工作模式。需要基于支持本地 ACID 事务的关系型数据库，Java 应用，通过 JDBC 访问数据库。

**2.1.1 整体机制**

该模式是XA协议的演变，XA协议是基于资源管理器实现，而AT并不是如此。AT的2个阶段分别是：

- **一阶段：**业务数据和回滚日志记录在同一个本地事务中提交，释放本地锁和连接资源。
- **二阶段：**提交异步化，非常快速地完成；回滚通过一阶段的回滚日志进行反向补偿。



下图中，步骤1开启全局事务；步骤2注册分支事务，这里对应着一阶段；

步骤3提交或者回滚分支事务，对应着二阶段。

<img src="https://youpaiyun.zongqilive.cn/image/20210124104341.png" style="zoom:150%;" />



**2.1.2 特点**

- **优点：**对代码无侵入；并发度高，本地锁在一阶段就会释放；不需要数据库对XA协议的支持。
- **缺点：**只能用在支持ACID的关系型数据库；SQL解析还不能支持全部语法。











