## ConcurrentLinkedQueue

* 一个无边界、线程安全且无阻塞的队列

- 不会因为队列为空而等待，而是直接返回null



### 类结构

队列由单向链表实现，ConcurrentLinkedQueue 持有头尾指针（head/tail 属性）来管理队列。

![](https://youpaiyun.zongqilive.cn/image/20210306153907.png)

队列进行出队入队时对节点的操作都是通过` CAS `实现，保证线程安全



### 如何保证并发安全性

需要保证线程安全的三种情况：

1. 多个线程同时 offer()：-- 入队

多个线程同时执行到 casNext()设置最后的节点，casNext()通过 CAS 实现，第一个线程执行成功设置了最后一个节点后，其他线程的在 CAS 时发现期望的最后节点和实际上的最后节点不一致，CAS 就会失败，然后继续循环尝试直到成功。

2. 多个线程同时 poll()：-- 出队

同样是通过 CAS 保证线程安全，多个线程同时执行到 casItem()设置当前节点 item=null，第一个线程执行成功设置了当前节点 item=null 后，其他线程的在 CAS 时发现期望的 item 与实际的 item 不一致，CAS 就会失败，然后继续循环尝试 poll 下一个节点直到成功。

3. 队列中只有一个元素时，线程 Aoffer()一个线程 Bpoll()：

线程 A 要设置 p.next=newNode，但是此时 poll()将 p 删除了。当 poll()将 p 删除时设置了 p.next=p，offer()方法中会检查这种情况，发现有 p.next=p 就重新设置一个合适的 p 节点，以便将 newNode 入队。



https://mp.weixin.qq.com/s/n6TO-r8P-_vSXxewHfvuAw

### 入队

![图片](https://youpaiyun.zongqilive.cn/image/640.jpeg)

- 添加元素1。队列更新head节点的next节点为元素1节点。又因为tail节点默认情况下等于head节点，所以它们的next节点都指向元素1节点。
- 添加元素2。队列首先设置元素1节点的next节点为元素2节点，然后更新tail节点指向元素2节点。
- 添加元素3，设置tail节点的next节点为元素3节点。
- 添加元素4，设置元素3的next节点为元素4节点，然后将tail节点指向元素4节点。

### 出队

<img src="https://youpaiyun.zongqilive.cn/image/20210306155337.png" style="zoom:150%;" />



并不是每次出队时都更新head节点，当head节点里有元素时，直接弹出head节点里的元素，而不会更新head节点。只有当head节点里没有元素时，出队操作才会更新head节点。







