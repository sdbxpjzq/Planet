![](https://youpaiyun.zongqilive.cn/image/5dff06c576085c32892c2142.jpg)

![](https://pic.superbed.cn/item/5dff086a76085c32892cb15b.jpg)



- `HashMap`-- 作为Map的的主要实现类, 线程不安全, 效率高, ==key 和value 允许为 null==
- `LinkedHashMap` --  保证在遍历map元素时, 可以按照添加的顺序实现遍历==,key 和value 允许为 null==
  - 原因: 在原有的HashMap底层结构的基础上, 添加了一对指针, 指向前一个和后一个元素
  - 对于频繁的遍历操作, 执行效率高于HashMap
- `TreeMap` -- 按照添加的key-value对进行排序, 实现排序遍历, ==key 和value 允许为 null==
  - 考虑key的自然排序或定制排序
- `HashTable` -- 古老的实现类, 线程安全的, 效率低 , ==key 和value 不允许为 null==





![](https://pic2.superbed.cn/item/5dff074776085c32892c5090.jpg)



![](https://pic1.superbed.cn/item/5dff08c176085c32892cd372.jpg)



































