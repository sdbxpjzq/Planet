![](https://ws4.sinaimg.cn/large/006tNc79ly1g295t85alvj30ih0btaaj.jpg)



- G (Goroutine)，代表协程，也就是每次代码中使用 `go 关键词`时候会创建的一个对象
- M (Machine)，工作线程(Work Thread)
- P (Processor)，代表一个`处理器`，又称上下文

#### G-M-P三者的关系与特点：

- 每一个运行的 M 都必须绑定一个 P，线程M 创建后会去检查并执行G (goroutine)对象

- 每一个 P 保存着一个协程G 的`队列`

- 除了每个 P 自身保存的 G 的队列外，调度器还拥有一个全局的 G 队列

- M 从`队列中`提取 G，并执行

  



## 静态模式

![](https://ws2.sinaimg.cn/large/006tNc79ly1g295udz137j30k00avdgq.jpg)

## 动态模式

![](https://ws4.sinaimg.cn/large/006tNc79ly1g295utxh6dj30k90av3zw.jpg)



![](https://ws3.sinaimg.cn/large/006tNc79ly1g2q5sjengaj30t70irq58.jpg)

