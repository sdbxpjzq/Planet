`byType` 通过匹配 bean 中所需要的依赖类型在容器上下文中自动寻找装配

 `byType` 的自动装配存在一个很严重的问题，因为不是通过唯一的 id 来匹配，而是通过类型来匹配，所以容器中不能存在多个相同类型的 bean。



![](https://youpaiyun.zongqilive.cn/image/20210313110330.png)

