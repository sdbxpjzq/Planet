
1、采取去中心化的集群模式，将数据按槽存储分布在多个 Redis 节点上。集群共有 16384 个槽，每个节点负责处理部分槽。

2、使用 CRC16 算法来计算 key 所属的槽：crc16(key,keylen) & 16383。

3、所有的 Redis 节点彼此互联，通过 PING-PONG 机制来进行节点间的心跳检测。

4、分片内采用一主多从保证高可用，并提供复制和故障恢复功能。在实际使用中，通常会将主从分布在不同机房，避免机房出现故障导致整个分片出问题，下面的架构图就是这样设计的。

5、客户端与 Redis 节点直连，不需要中间代理层（proxy）。客户端不需要连接集群所有节点，连接集群中任何一个可用节点即可。



![](https://youpaiyun.zongqilive.cn/image/20210301185446.png)











![](https://youpaiyun.zongqilive.cn/image/20200613180615.png)

每个节点分配 一定范围的 槽



![](https://youpaiyun.zongqilive.cn/image/20200916111351.png)

