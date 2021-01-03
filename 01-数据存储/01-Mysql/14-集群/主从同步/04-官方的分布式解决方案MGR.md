MySQL Group Replication



MySQL从5.7.17通过引入组复制[1]的架构，通过在MySQL 8.0的不断优化，提高了MGR的可用性，很多企业或团队都已经在项目中使用(可参考：MySQL Group Replication性能测试，

MGR是MySQL原生的高可用和可扩展解决方案，以插件的方式实现分布式下`数据最终一致性`，主要特点：

- 一致性和容错性

- - 使用分布式协议(类Paxos)实现容错和多节点协调
  - 自动检测节点状态，能自动选举

- 扩展性

- - 支持节点的新增和删除，并能实现数据同步
  - 支持单个Primary和多个Primary模式(单节点写或多节点写)





https://mp.weixin.qq.com/s/_WzogekOOPUF_vDpe_wrFg

