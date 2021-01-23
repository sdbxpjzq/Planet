概要：

一、Dubbo 调用模块基本组成

二、调用内部实现源码分析


## 一、Dubbo 调用模块基本组成

---
### **Dubbo调用模块概述：**
dubbo调用模块核心功能是发起一个远程方法的调用并顺利拿到返回结果，其体系组成如下：

1. **透明代理：**通过动态代理技术，屏蔽远程调用细节以提高编程友好性。
2. **负载均衡：**当有多个提供者是，如何选择哪个进行调用的负载算法。
3. **容错机制：**当服务调用失败时采取的策略
4. **调用方式：**支持同步调用、异步调用

![图片](https://images-cdn.shimo.im/EKumlxdB8ygnUt0i/image.png!thumbnail)


### 透明代理：
参见源码：

com.alibaba.dubbo.config.ReferenceConfig#createProxy

com.alibaba.dubbo.common.bytecode.ClassGenerator

com.alibaba.dubbo.rpc.proxy.javassist.JavassistProxyFactory

### **负载均衡**
Dubbo 目前官方支持以下负载均衡策略：

1. **随机**(random)：按权重设置随机概率。此为默认算法.
2. **轮循 **(roundrobin):按公约后的权重设置轮循比率。
3. **最少活跃调用数**(leastactive):相同活跃数的随机，活跃数指调用前后计数差。
4. **一致性Hash**(consistenthash ):相同的参数总是发到同一台机器

设置方式支持如下四种方式设置，优先级由低至高

```
<!-- 服务端级别-->
<dubbo:service interface="..." loadbalance="roundrobin" />
<!-- 客户端级别-->
<dubbo:reference interface="..." loadbalance="roundrobin" />
<!-- 服务端方法级别-->
<dubbo:service interface="...">
    <dubbo:method name="..." loadbalance="roundrobin"/>
</dubbo:service>
<!-- 客户端方法级别-->
<dubbo:reference interface="...">
    <dubbo:method name="..." loadbalance="roundrobin"/>
</dubbo:reference>
```
#TODO 一至性hash 演示

- [ ] 配置loadbalance
- [ ] 配置需要hash 的参数与虚拟节点数
- [ ] 发起远程调用

一至性hash 算法详解：

![图片](https://images-cdn.shimo.im/2ng2Z09XeC8W2znz/一至性啥希.png!thumbnail)

### **容错**
Dubbo 官方目前支持以下容错策略：

1. **失败自动切换：**调用失败后基于retries=“2” 属性重试其它服务器
2. **快速失败：**快速失败，只发起一次调用，失败立即报错。
3. **勿略失败：**失败后勿略，不抛出异常给客户端。
4. **失败重试：**失败自动恢复，后台记录失败请求，定时重发。通常用于消息通知操作
5. **并行调用: **只要一个成功即返回，并行调用指定数量机器，可通过 forks="2" 来设置最大并行数。
6. **广播调用：**广播调用所有提供者，逐个调用，任意一台报错则报错 

设置方式支持如下两种方式设置，优先级由低至高

```
<!-- 
Failover 失败自动切换 retries="1" 切换次数
Failfast 快速失败
Failsafe 勿略失败
Failback 失败重试，5秒后仅重试一次
Forking 并行调用  forks="2" 最大并行数
Broadcast 广播调用
-->
<dubbo:service interface="..." cluster="broadcast" />
<dubbo:reference interface="..." cluster="broadcast"/ >
```
注：容错机制 在基于 API设置时无效 如   referenceConfig.setCluster("failback"); 经测试不启作用 
### **异步调用**
	异步调用是指发起远程调用之后获取结果的方式。

1. 同步等待结果返回（默认）
2. 异步等待结果返回
3. 不需要返回结果

Dubbo 中关于异步等待结果返回的实现流程如下图：

![图片](https://images-cdn.shimo.im/OPdbf7GTUcs1Q9DQ/image.png!thumbnail)

异步调用配置:

```
<dubbo:reference id="asyncDemoService"
                 interface="com.tuling.teach.service.async.AsyncDemoService">
                 <!-- 异步调async：true 异步调用 false 同步调用-->
    <dubbo:method name="sayHello1" async="false"/>
    <dubbo:method name="sayHello2" async="false"/>
     <dubbo:method name="notReturn" return="false"/>
</dubbo:reference>
```
注：在进行异步调用时 容错机制不能为  cluster="forking" 或  cluster="broadcast"

**异步获取结果演示：**

- [ ] 编写异步调用代码
- [ ] 编写同步调用代码
- [ ] 分别演示同步调用与异步调用耗时

*异步调用结果获取Demo*

```
demoService.sayHello1("han");
Future<Object> future1 = RpcContext.getContext().getFuture();
demoService.sayHello2("han2");
Future<Object> future2 = RpcContext.getContext().getFuture();
Object r1 = null, r2 = null;
// wait 直到拿到结果 获超时
r1 = future1.get();
// wait 直到拿到结果 获超时
r2 = future2.get();
```
### **过滤器**
** 类似于 WEB 中的Filter ，Dubbo本身提供了Filter 功能用于拦截远程方法的调用。其支持自定义过滤器与官方的过滤器使用：**

#TODO 演示添加日志访问过滤:

```
<dubbo:provider  filter="accesslog" accesslog="logs/dubbo.log"/>
```
以上配置 就是 为 服务提供者 添加 日志记录过滤器， 所有访问日志将会集中打印至 accesslog 当中
## 二  、调用内部实现源码分析

---
**知识点**

1. 分析代理类
2. 分析类结构
3. 初始化过程
1. 分析代理类

在调用服务端时，是接口的形式进行调用，该接口是Duboo 动态代理之后的实现，通过反编译工具可以查看到其具体实现：

因为类是代理生成，所以采用[arthas](https://github.com/alibaba/arthas)工具来反编译，具体操作如下：

```
#运行 arthas
java -jar arthas-boot.jar
#扫描类
sc *.proxy0
#反编译代理类
jad com.alibaba.dubbo.common.bytecode.proxy0
```
反编译的代码如下：
```
/*
 * Decompiled with CFR.
 *
 * Could not load the following classes:
 *  com.tuling.client.User
 *  com.tuling.client.UserService
 */
package org.apache.dubbo.common.bytecode;
import com.alibaba.dubbo.rpc.service.EchoService;
import com.tuling.client.User;
import com.tuling.client.UserService;
import java.lang.reflect.InvocationHandler;
import java.lang.reflect.Method;
import java.util.List;
import org.apache.dubbo.common.bytecode.ClassGenerator;
public class proxy0
implements ClassGenerator.DC,
EchoService,
UserService {
    public static Method[] methods;
    private InvocationHandler handler;
    public List findUser(String string, String string2) {
        Object[] arrobject = new Object[]{string, string2};
        Object object = this.handler.invoke(this, methods[0], arrobject);
        return (List)object;
    }
    public User getUser(Integer n) {
        Object[] arrobject = new Object[]{n};
        Object object = this.handler.invoke(this, methods[1], arrobject);
        return (User)object;
    }
    @Override
    public Object $echo(Object object) {
        Object[] arrobject = new Object[]{object};
        Object object2 = this.handler.invoke(this, methods[2], arrobject);
        return object2;
    }
    public proxy0() {
    }
    public proxy0(InvocationHandler invocationHandler) {
        this.handler = invocationHandler;
    }
}
```
可看出其代理实现了 UserService  接口。并且基于InvocationHandler 进行代理。实际类是 InvokerInvocationHandler 并且其中之属性为Invoker.。也就是说最终会调用Invoker进行远程调用。

1. 分析类结构关系
* prxoy$: 代理类
* Invoker: 执行器
* Invocation: 执行参数与环境
* Result：返回结果
* Protocol:协议

