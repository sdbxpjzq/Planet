## kill 和 kill -9

### kill

kill  默认执行的是 `kill -15 PID`

系统会发送一个SIGTERM的信号给对应的程序,  告诉应用主动关闭., 效果是正常退出进程



### kill -9

`kill -9 PID` 操作系统从内核级别强制杀死一个进程.

你不是可以不响应 SIGTERM吗？？那好，我给你下一道必杀令.

