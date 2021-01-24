该模式工作分为三个阶段：

try/commit/cancel。

**2.2.1 整体机制**

-  TM向TC申请全局事务XID，传播给各个子调用。
- 子调用的所在TM向TC注册分支事务，并执行本地try，并向TC报告执行结果。
- TC根据各分支事务的执行结果确定二阶段是执行commit或rollback。



<img src="https://youpaiyun.zongqilive.cn/image/20210124104442.png" style="zoom:150%;" />



**2.2.2 特点**

- **优点：**不依赖本地事务。
- **缺点：**回滚逻辑依赖手动编码；业务侵入性较大。

