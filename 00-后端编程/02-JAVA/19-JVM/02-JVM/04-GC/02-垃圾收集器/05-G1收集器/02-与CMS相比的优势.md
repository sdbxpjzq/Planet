### 与CMS相比的优势

1）G1不会产生内存碎片
2）是可以精确控制停顿，该收集器是把整个堆（新生代、老年代）划分成多个固定大小的区域，每次根据允许停顿的时间去收集垃圾最多的区域





## G1的不足:

相较于CMS, G1还不具备全方位, 压倒性优势,  比如在用户程序运行过程中, G1无路是为了垃圾收集产生的内存占用(Footprint)还是程序运行时的额外执行负载,(Overload)都要比CMS要高

从经验上来说, ==在小内存应用 --> CMS,  大内存应用 --> G1,  平衡点: 6-8G==





