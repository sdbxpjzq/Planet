同样是一个LIFO（Last In First Out，后入先出）的栈结构，用于计算的临时存储区

- 操作数栈主要用于保存计算过程的中间结果, 同时作为计算过程中变量临时的存储空间.
- 每一个操作数栈都会拥有一个明确的栈深度用于存储数值, 其所需的最大深度在编译期就定义好了, 保存在方法的Code属性中, 为max_stack的值
- 栈中的任何一个元素都是可以任意的java数据类型
  - 32bit的类型占用一个栈单位深度
  - 64bit的类型占用2个栈单位深度
- 如果被调用的方法带由返回值的话, 其返回值将会被压入当前栈帧的操作数栈中,  并更新PC寄存器中下一条需要执行的字节码指令
- 



![](https://youpaiyun.zongqilive.cn/image/20200319182651.png)

![](https://youpaiyun.zongqilive.cn/image/20200319182704.png)






## 栈顶缓存技术(Top-of-Stack-Cashing)

![](https://youpaiyun.zongqilive.cn/image/20200319183052.png)









