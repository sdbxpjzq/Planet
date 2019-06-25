正常情况下，客户端发送一个命令，等待Redis应答，Redis在接收到命令处理后应答，即 RTT(Round Time Trip)。





pipeline`可以将多次IO往返的时间缩减为一次，节省多次IO往返的时间, 前提是pipeline执行的指令之间没有因果相关性, 

有顺序依赖的执行建议分分批次发送



https://mp.weixin.qq.com/s/291HylA_KkHrAf2OlOQURQ