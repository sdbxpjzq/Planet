## 乐观锁和悲观锁

![](https://youpaiyun.zongqilive.cn/image/20200613172743.png)



**WATCH命令是一个乐观锁**，它可以在EXEC命令执行之前，监视任意数量的数据库键，并在EXEC命令执行时，检查被监视的键是否至少有一个已经被修改过了，如果是的话，服务器将拒绝执行事务，并向客户端返回代表事务执行失败的空回复。



![](https://youpaiyun.zongqilive.cn/image/006tNc79ly1g4ck2mnvoaj31ou0kc40i.jpg)

客户端A执行事务失败。原因分析如下：

在时间T4，客户端B修改了“name"键的值，当客户端A在T5执行EXEC命令时，服务器会发现WATCH监视的键”name“已经被修改，因此服务器拒接执行客户端A的事务，并向客户端A发送了空回复。





































