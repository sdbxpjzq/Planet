![](https://youpaiyun.zongqilive.cn/image/20200603185617.png)
![](https://youpaiyun.zongqilive.cn/image/20200603185723.png)
![](https://youpaiyun.zongqilive.cn/image/20200603185813.png)
![](https://youpaiyun.zongqilive.cn/image/20200603185849.png)

```java
class CanReLiveObj {
    public static CanReLiveObj obj;

    @Override
    protected void finalize() throws Throwable {
        super.finalize();
        System.out.println("调用当前类重写的finalize()方法");
        obj = this;
    }

    public static void main(String[] args) throws InterruptedException {
         obj = new CanReLiveObj();
        // 对象第一次成功拯救自己
        obj = null;
        System.gc();
        System.out.println("第1次GC");

        // 因为Finalizer线程优先级很低, 暂停2秒, 等待它
        TimeUnit.SECONDS.sleep(2);
        if (obj == null) {
            System.out.println("obj is dead");
        } else {
            System.out.println("obj is still alive");
        }


        System.out.println("第2次GC");
        // 下面这段代码和 上面的完全相同, 但是这次自救失败了
        obj = null;
        System.gc();
        TimeUnit.SECONDS.sleep(2);
        if (obj == null) {
            System.out.println("obj is dead");
        } else {
            System.out.println("obj is still alive");
        }

    }
}
```

## 被GC判断为”垃圾”的对象一定会回收吗

即使在可达性分析算法中不可达的对象,也并非是“非死不可”的,这时候它们**暂时处于“缓刑”阶段,要真正宣告一个对象死亡,至少要经历两次标记过程**:

如果对象在进行可达性分析后发现没有与GC Roots相连接的引用链,那它将会被第一次标记并且进行一次`筛选`,**筛选的条件是此对象是否有必要执行finalize()方法。**

**当对象没有覆盖finalize()方法,或者finalize()方法已经被虚拟机调用过,虚拟机将这两种情况都视为“没有必要执行”。(即意味着直接回收)**

如果这个对象被判定为有必要执行finalize（）方法，那么这个对象将会放置在一个叫做F-Queue的队列之中，并在稍后由一个由虚拟机自动建立的、低优先级的Finalizer线程去执行它。这里所谓的“执行”是指虚拟机会触发这个方法，但并不承诺会等待它运行结束，这样做的原因是，如果一个对象在finalize（）方法中执行缓慢，或者发生了死循环（更极端的情况），将很可能会导致F-Queue队列中其他对象永久处于等待，甚至导致整个内存回收系统崩溃。finalize（）方法是对象逃脱死亡命运的最后一次机会，稍后GC将对F-Queue中的对象进行第二次小规模的标记，如果对象要在finalize（）中成功拯救自己——只要重新与引用链上的任何一个对象建立关联即可，譬如把自己（this关键字）赋值给某个类变量或者对象的成员变量，那在第二次标记时它将被移除出“即将回收”的集合；如果对象这时候还没有逃脱，那基本上它就真的被回收了

## Finalize方法具有以下四个特点

1. 永远不要主动调用某个对象的finalize方法，该方法应该交给垃圾回收机制调用。
2. Finalize方法合适被调用，是否被调用具有不确定性，不要把finalize方法当做一定会执行的方法，
3. 当JVM执行课恢复对象的finalize方法时，可能是改对象或系统中其他对象重新变成可达状态
4. 当JVM调用finalize方法出现异常时，垃圾回收机制不会报告异常，程序继续执行。

**注意点：**

> 由于finalize方法不一定被执行，那么我们想清理某各类里打开的资源时，则不要写在finalize方法中。

```java
public class FinalizeEscapeGC {
  public static FinalizeEscapeGC SAVE_HOOK = null;

  public void isAlive() {
    System.out.println("yes,i am still alive:)");
  }

  @Override
  protected void finalize() throws Throwable {
    super.finalize();
    System.out.println("finalize mehtod executed!");
    FinalizeEscapeGC.SAVE_HOOK = this;
  }

  public static void main(String[] args) throws Throwable {
    SAVE_HOOK = new FinalizeEscapeGC();
    // 对象第一次成功拯救自己
    SAVE_HOOK = null;
    System.gc();
    // 因为finalize方法优先级很低,所以暂停0.5秒以等待它
    Thread.sleep(500);
    if (SAVE_HOOK != null) {
      SAVE_HOOK.isAlive();
    } else {
      System.out.println("no,i am dead:(");
    }
    // 下面这段代码与上面的完全相同,但是这次自救却失败了, (因为finalize方法执行过了)
    SAVE_HOOK = null;
    System.gc();
    // 因为finalize方法优先级很低,所以暂停0.5秒以等待它
    Thread.sleep(500);
    if (SAVE_HOOK != null) {
      SAVE_HOOK.isAlive();
    } else {
      System.out.println("no,i am dead:(");
    }
  }
}

```

运行结果

```
finalize mehtod executed!
yes,i am still alive:)
no,i am dead:(
```

从运行结果可以看出，`SAVE_HOOK`对象的`finalize()`方法确实被GC收集器触发过，并且在被收集前成功逃脱了。另外一个值得注意的地方是，代码中有两段完全一样的代码片段，执行结果却是一次逃脱成功，一次失败，这是因为任何一个对象的`finalize()`方法都只会被系统`自动调用一次`，如果对象面临下一次回收，它的`finalize()`方法不会被再次执行,(即意味着直接回收)因此第二段代码的自救行动失败了。













































