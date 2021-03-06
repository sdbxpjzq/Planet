我们先用ps命令找到对应`进程的pid`(如果你有好几个目标进程，可以先用top看一下哪个占用比较高)。

接着用`top -H -p pid`来找到cpu使用率比较高的一些线程





然后将占用最高的pid转换为16进制`printf '%x\n' pid`得到nid

![](https://youpaiyun.zongqilive.cn/image/20210306175140.png)

接着直接在jstack中找到相应的堆栈信息`jstack pid |grep 'nid' -C5 –color`

![](https://youpaiyun.zongqilive.cn/image/20210306175207.png)

当然更常见的是我们对整个jstack文件进行分析，通常我们会比较关注WAITING和TIMED_WAITING的部分，BLOCKED就不用说了。我们可以使用命令`cat jstack.log | grep "java.lang.Thread.State" | sort -nr | uniq -c`来对jstack的状态有一个整体的把握，如果WAITING之类的特别多，那么多半是有问题啦。

