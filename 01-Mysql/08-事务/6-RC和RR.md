MySQL数据库中默认隔离级别为RR，但是实际情况是使用RC 和 RR隔离级别的都不少.

## **RC 与 RR 在锁方面的区别**

1. RR 支持 gap lock(next-key lock)，而RC则没有gap lock。因为MySQL的RR需要gap lock来解决幻读问题。而RC隔离级别则是允许存在不可重复读和幻读的。所以RC的并发一般要好于RR
2. RC 隔离级别，通过 where 条件过滤之后，不符合条件的记录上的行锁，会释放掉(虽然这里破坏了“两阶段加锁原则”)；但是RR隔离级别，即使不符合where条件的记录，也不会是否行锁和gap lock；所以从锁方面来看，RC的并发应该要好于RR





