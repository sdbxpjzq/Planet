ServerletContext对象

代表整个web应用, 可以和程序的容器(服务器)来通信

## 获取

方式1: 通过request对象获取

`request.getServletContext`

方式2: 通过`HttpServlet`获取

`this.getServletContext()`



![](https://pic.superbed.cn/item/5dc127c08e0e2e3ee90cf1d6.jpg)



## 共享数据

![](https://pic.superbed.cn/item/5dc128498e0e2e3ee90cffba.jpg)

服务器关闭 数据销毁, 谨慎使用, 存储的数据多了, 增加内存压力

## 获取MIME类型

![](https://pic.superbed.cn/item/5dc128838e0e2e3ee90d04b1.jpg)

## 获取文件真实(服务器)地址

![](https://pic.superbed.cn/item/5dc129148e0e2e3ee90d12ec.jpg)

















