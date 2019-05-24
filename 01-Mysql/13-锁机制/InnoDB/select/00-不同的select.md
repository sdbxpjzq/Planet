InnoDB有两种不同的SELECT，即`普通SELECT` 和 `锁定读SELECT`。

锁定读SELECT 又有两种，即`SELECT ... FOR SHARE` 和 `SELECT ... FOR UPDATE`；

锁定读SELECT 之外的则是 普通SELECT 。

不同的SELECT是否都需要加锁呢？

1、普通SELECT 时使用一致性非锁定读，不加锁；

2、锁定读SELECT 使用锁定读，加锁；

3、此外，DML(INSERT/UPDATE/DELETE)时，需要先查询表中的记录，此时也使用锁定读，加锁；



