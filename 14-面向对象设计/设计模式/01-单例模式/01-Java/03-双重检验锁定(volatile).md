## 为什么要用volatile

> 禁止指令重排

![](https://youpaiyun.zongqilive.cn/image/20210127154837.png)



```java
public class Singleton {

    static Singleton instance;

    static Singleton getInstance() {
      // 这一层判断主要是提高效率
        if (instance == null) {
            synchronized (Singleton.class) {
              // 但是由于没有内层 if (instance == null) ，第一批进入的每一个线程都会创建一个对象，破坏单例模式
                if (instance == null)
                    instance = new Singleton();
            }
        }
        return instance;
    }
}
```

我们先看 `instance=new Singleton()` 的未被编译器优化的操作

- 指令 1：分配一块内存 M；
- 指令 2：在内存 M 上初始化 Singleton 对象；
- 指令 3：然后 M 的地址赋值给 instance 变量。

编译器优化后的操作指令

- 指令 1：分配一块内存 M；
- 指令 2：将 M 的地址赋值给 instance 变量；
- 指令 3：然后在内存 M 上初始化 Singleton 对象。

现在有A，B两个线程，我们假设线程A先执行getInstance()方法，当执行编译器优化后的操作指令2时（此时候未完成对象的初始化），这时候发生了线程切换，那么线程B进入，刚好执行到第一次判断 instance==null会发现instance不等于null了，所以直接返回instance，而此时的 instance 是没有初始化过的。

![](https://youpaiyun.zongqilive.cn/image/20200712144415.png)





## 变量添加 `volatile`修饰

```java
public class Singleton {
    //指向实例的私有静态引用
    private volatile static Singleton singleton;
    //私有构造方法
    private Singleton(){
    }
    //返回唯一实例的静态public方法
    public static Singleton getInstance(){
        if(null==singleton){
            synchronized(Singleton.class){
                if(null==singleton){
                    singleton=new Singleton();
                }
            }
        }
        return singleton;
    }
}


```



















