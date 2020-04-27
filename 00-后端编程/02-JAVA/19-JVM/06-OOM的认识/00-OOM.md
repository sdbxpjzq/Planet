![](https://youpaiyun.zongqilive.cn/image/20200425141601.png)

![](https://youpaiyun.zongqilive.cn/image/20200425141954.png)



## StackOverflowError

栈空间溢出 ，递归调用卡死

![](https://youpaiyun.zongqilive.cn/image/20200425141629.png)

## OutOfMemoryError:Java heap space

堆内存溢出 ， 对象过大

设置`-Xms10m -Xmx10m -XX:+PrintGCDetails`

```java
String str = "www.zongqilive.cn";
while (true) {
  str += str + new Random().nextInt(888888)+new Random().nextInt(999999);
}

// Exception in thread "main" java.lang.OutOfMemoryError: Java heap space
```

![](https://youpaiyun.zongqilive.cn/image/20200425142054.png)



## OutOfMemoryError:GC overhead limit exceeded

GC回收时间过长

- 过长的定义是超过98%的时间用来做GC并且回收了而不倒2%的堆内存

- 连续多次GC，都回收了不到2%的极端情况下才会抛出

- 如果不抛出，那就是GC清理的一点内存很快会被再次填满，迫使GC再次执行，这样就恶性循环，

- cpu使用率一直是100%，二GC却没有任何成果

```java
int i = 0;
List<String> list = new ArrayList<>();
try{
  while(true){
    list.add(String.valueOf(++i).intern());
  }
}catch(Throwable e){
  System.out.println("********");
  e.printStackTrace();
  throw e;
}

```



## OutOfMemoryError:Direct buffer memory

执行内存挂了

![](https://youpaiyun.zongqilive.cn/image/20200425142331.png)

- 写NIO程序经常使用 ByteBuffer 来读取或者写入数据，这是一种基于通道（Channel）和缓冲区（Buffer）的 I/O 方式，它可以使用 Native 函数库直接分配堆外内存，然后通过一个存储在Java 堆里面的DirectByteBuffer 对象作为这块内存的引用进行操作。这样能在一些场景中显著提高性能，因为**避免了在Java堆和Native堆中来回复制数据。**

- ByteBuffer.allocate(capability) ：这一种方式是分配JVM堆内存，属于GC管辖范围，由于需要拷贝所以速度相对较慢。

- ByteBuffer.allocateDirect(capability)：这一种方式是分配OS本地内存，不属于GC管辖范围，由于不需要内存拷贝，所以速度相对较快。

- 但是如果不断分配本地内存，堆内存很少使用，那么JVM就不需要执行GC，DirectByteBuffer 对象就不会被回收，这时候堆内存充足，但本地内存可能就已经使用光了，再次尝试分配本地内存就会出现OutOfMemeoryError，那程序就直接奔溃了。

![](https://youpaiyun.zongqilive.cn/image/20200425142441.png)

## OutOfMemoryError:unable to create new native thread

![](https://youpaiyun.zongqilive.cn/image/20200425142524.png)

- 应用创建了太多线程，一个应用进程创建了多个线程，超过系统承载极限
- 你的服务器并不允许你的应用程序创建这么多线程，linux系统默认允许单个进程可以创建的线程数是1024，超过这个数量，就会报错

解决办法

```
1. 降低应用程序创建线程的数量，分析应用给是否针对需要这么多线程，如果不是，减到最低
2. 修改linux服务器配置

```



![](https://youpaiyun.zongqilive.cn/image/20200425142605.png)



## OutOfMemoryError:Metaspace

元空间主要存放了虚拟机加载的类的信息、常量池、静态变量、即时编译后的代码

![](https://youpaiyun.zongqilive.cn/image/20200425142815.png)

```java
static class OOMTest{}
public static void main(String[] args){
  int i = 0;
  try{
    while(true){
      i++;
      Enhancer enhancer = new Enhancer();
      enhancer.setSuperclass(OOMTest.class);
      enhancer.setUseCache(false);
      enhancer.setCallback(new MethodInterceptor(){
        @Override
        public Object intercept(Object o,Method method,Object[] objects,
                                MethodProxy methodProxy)throws Throwable{
          return methodProxy.invokeSuper(o,args);
        }
      });
      enhancer.create();
    } 
  } catch(Throwable e){
    System.out.println(i+"次后发生了异常");
    e.printStackTrace();
  }
}

```



















































