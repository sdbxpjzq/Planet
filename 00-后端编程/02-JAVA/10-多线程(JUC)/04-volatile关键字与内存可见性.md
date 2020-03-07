

```java
public class ThreadDemo implements Runnable {
  //默认 false
  private Boolean flag = false;
  @Override
  public void run() {
    try {
      // 延迟 
      Thread.sleep(2000);
    } catch (InterruptedException e) {
      e.printStackTrace();
    }
    // 修改为 true
    flag = true;
    System.out.println("ThreadDemo=======flag====true");
  }

  public Boolean getFlag() {
    return flag;
  }

  public void setFlag(Boolean flag) {
    this.flag = flag;
  }
}
```

```java
public class main {
  public static void main(String[] args) {
    ThreadDemo threadDemo = new ThreadDemo();
    new Thread(threadDemo).start();
    while (true) {
      if (threadDemo.getFlag()) { // main 先执行,  拿到的还是 false
        System.out.println("main ======== flag ==== true");
        break;
      }
    }
  }
}
```

可见执行明显是有问题的.

![](https://youpaiyun.zongqilive.cn/image/20200307153407.png)



## 解决办法

1. `synchronized`, 效率低

   ![](https://youpaiyun.zongqilive.cn/image/20200307153745.png)

2. `volatile`关键字

   ```java
   // 将变量修饰城 volatile
   private volatile boolean flag = false; 
   ```

   当多个线程进行操作共享数据时, 可以保证内存中的数据可见,

   相交于`synchronized`是一种较为轻量的同步策略

![](https://youpaiyun.zongqilive.cn/image/20200307155336.png)



## `volatile`注意

`volatile`不具备`互斥性`

`volatile` 不能保证变量的`原子性`

























































































































