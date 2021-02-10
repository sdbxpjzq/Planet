## CLH队列

既然是 AQS 中使用的是 CLH 变体队列，我们先来了解下 CLH 队列是什么

CLH：Craig、Landin and Hagersten 队列，是 **单向链表实现的队列**。

申请线程只在本地变量上自旋，**它不断轮询前驱的状态**，如果发现 **前驱节点释放了锁就结束自旋**

![](https://youpaiyun.zongqilive.cn/image/20210124163143.png)

通过对 CLH 队列的说明，可以得出以下结论

1. CLH 队列是一个单向链表，保持 FIFO 先进先出的队列特性
2. 通过 tail 尾节点（原子引用）来构建队列，总是指向最后一个节点
3. 未获得锁节点会进行自旋，而不是切换线程状态
4. 并发高时性能较差，因为未获得锁节点不断轮训前驱节点的状态来查看是否获得锁



## AQS中得变体队列

AQS 中的队列是 CLH 变体的虚拟双向队列，通过将每条请求共享资源的线程封装成一个节点来实现锁的分配

![](https://youpaiyun.zongqilive.cn/image/20210124163406.png)

相比于 CLH 队列而言，AQS 中的 CLH 变体等待队列拥有以下特性

1. AQS 中队列是个双向链表，也是 FIFO 先进先出的特性
2. 通过 Head、Tail 头尾两个节点来组成队列结构，通过 volatile 修饰保证可见性
3. Head 指向节点为已获得锁的节点，是一个虚拟节点，节点本身不持有具体线程
4. 获取不到同步状态，会将节点进行自旋获取锁，自旋一定次数失败后会将线程阻塞，相对于 CLH 队列性能较好



## 入队和出队

https://mp.weixin.qq.com/s/5pHmIeMJrYOHLoO5WVXqww

```java
private Node enq(final Node node) {
  for (;;) {
    Node t = tail;
    if (t == null) { // Must initialize
      if (compareAndSetHead(new Node()))
        tail = head;
    } else {
      node.prev = t;
      if (compareAndSetTail(t, node)) {
        t.next = node;
        return t;
      }
    }
  }
}
```

- 判断队列的尾指针是否为空，现在由于队列中没有任何 node，所以条件成立。但是这里并**不是把传进来的 node 放进队列，而是先 new 了一个空的 node，放进队列，作为头结点**（有时候也称作傀儡节点，或者哨兵节点，它的作用只是用来占位），并且把尾节点也指向它。这里相当于队列的初始化。第一次循环结束。

  ![](https://youpaiyun.zongqilive.cn/image/20210210174130.png)

- 

- 第二次循环，队列的尾指针不再为空了，把传进来的 node（也就是线程B）加入队列。自旋阻塞

  ![](https://youpaiyun.zongqilive.cn/image/20210210174312.png)
  
  
  
  



































