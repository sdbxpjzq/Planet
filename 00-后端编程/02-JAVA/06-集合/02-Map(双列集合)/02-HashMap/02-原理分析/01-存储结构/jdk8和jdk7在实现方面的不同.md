



## jdk8和jdk7在实现方面的不同

- 初始化的不同
  - JDK7: `new HashMap()` 就会创建一个长度为16 的数组
  - JDK8:  数组延迟创建,  首次调用`put()`时, 底层创建长度为`16`的数组
- 链表节点的插入位置不同 - (7上, 8下)
  - JDK7 : 新添加的`key-value`在链表的头部
  - JDK8: 新添加的`key-value`在链表的尾部

- 存储结构不同
  - JDK7: `数组+链表`
  - JDK8:  `数组+链表+红黑树`



![](https://pic3.superbed.cn/item/5dff115d76085c328930b237.jpg)

![](https://pic3.superbed.cn/item/5dff11b576085c328930e504.jpg)