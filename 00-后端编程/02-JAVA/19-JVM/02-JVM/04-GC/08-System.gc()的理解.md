

- 在默认情况下, 通过`System.gc()`或者`Runtime.getRuntime().gc()`的调用, 会显示触发Full GC
- 然而`System.gc()`调用附带一个==免责声明: 只是提醒垃圾回收, 并不能保证立刻执行垃圾回收==



## 手动gc理解不可达对象的回收行为

> 脱离作用域 , 对象不可达

```java
class Test2 {
  public static void main(String[] args) {
    m2();
  }

  public static void m1() {
    {
      byte[] bytes = new byte[10 * 1024 * 1024];// 10m
    }
    System.gc(); // 没有回收
  }

  public static void m2() {
    {
      byte[] bytes = new byte[10 * 1024 * 1024];// 10m
    }
    int value = 10;
    System.gc(); // 回收了
  }

  public static void m3() {
    byte[] bytes = new byte[10 * 1024 * 1024];// 10m
    System.gc(); // 没有回收
  }

  public static void m4() {
    byte[] bytes = new byte[10 * 1024 * 1024];// 10m
    bytes = null;
    System.gc(); // 回收了
  }

  public static void m5() {
    m3();
    System.gc(); // 回收了
  }
}
```

