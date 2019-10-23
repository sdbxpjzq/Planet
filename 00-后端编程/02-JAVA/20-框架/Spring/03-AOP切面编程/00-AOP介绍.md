AOP（Aspect-Oriented Programming），即面向切面编程

在OOP中，我们以类（class）作为基本单元，而AOP中的基本单元是`Aspect(切面)`。

 ==**`AOP`底层将采用代理机制进行实现**==  

# 术语

1. `target`：目标类，需要被代理的类。例如：UserService
2. `Joinpoint(连接点)`:所谓连接点是指那些可能被拦截到的方法。例如：所有的方法
3. `PointCut 切入点`：已经被增强的连接点。例如：addUser()
4. `advice` 通知/增强，增强代码。例如：after、before
5. `Weaving(织入)`:是指把增强advice应用到目标对象target来创建新的代理对象proxy的过程.
6. `proxy` 代理类
7. `Aspect(切面)`: 是切入点`pointcut`和通知`advice`的结合



![](https://pic.superbed.cn/item/5dafff5c8b58bc7bf7cefd6c.jpg)



















