TCC 的模式叫做 `Try`、`Confirm`、`Cancel`，实际上也就是 2PC 的一个变种而已

<img src="https://youpaiyun.zongqilive.cn/image/20210124100826.png" style="zoom:150%;" />



实现这个模式，一个事务的接口需要拆分成3个，也就是 Try 预占、Confirm 确认提交、最后Cancel回滚。



如果说有简单的应用的话，库存的应用或许可以算做是一个。

一般库存的操作，很多实现方案里面都会会在下单的时候先预占库存，下单成功之后再实际去扣减库存，最终如果发生了异常再回退。

![](https://youpaiyun.zongqilive.cn/image/20210124100943.png)

冻结、预占库存就是 2PC 的准备阶段，真正下单成功去扣减库存就是 2PC 的提交阶段，回滚就是某个发生异常的回滚操作，只不过在应用层面来实现了 2PC 的机制而已。

















