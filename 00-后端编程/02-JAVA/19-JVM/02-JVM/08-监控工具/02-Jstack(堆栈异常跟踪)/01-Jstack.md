## jstack

<img src="https://youpaiyun.zongqilive.cn/image/20210117172518.png" style="zoom:200%;" />

主要用来定位线程出现长时间停顿的原因，判断死锁啊，死循环的等。



![](https://youpaiyun.zongqilive.cn/image/20210117172631.png)

## jstack找出占用cpu最高的堆栈信息

1，使用命令`top -p <pid>` ，显示你的java进程的内存情况，pid是你的java进程号，比如4977

2. 按H，获取每个线程的内存情况

3. 找到内存和cpu占用最高的线程tid，比如4977

4. 转为十六进制得到 0x1371 ,此为线程id的十六进制表示

5. 执行 jstack 4977|grep -A 10 1371，得到线程堆栈信息中1371这个线程所在行的后面10行

 6，查看对应的堆栈信息找出可能存在问题的代码







