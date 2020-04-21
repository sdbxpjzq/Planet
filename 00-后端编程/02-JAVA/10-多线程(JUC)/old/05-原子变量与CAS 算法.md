![](https://youpaiyun.zongqilive.cn/image/20200307172419.png)

```java
public class C1 implements Runnable {
  // private volatile int  num = 1;
  private AtomicInteger num = new AtomicInteger();
  @SneakyThrows
  public void run() {
    Thread.sleep(3000);
    System.out.println(Thread.currentThread().getName() +":"+getNum());
  }

  public Integer getNum() {
    return num.getAndIncrement();
  }
}
```

## 模拟CAS算法

```java
/*
 * 模拟 CAS 算法
 */
public class TestCompareAndSwap {

  public static void main(String[] args) {
    final CompareAndSwap cas = new CompareAndSwap();

    for (int i = 0; i < 10; i++) {
      new Thread(new Runnable() {

        @Override
        public void run() {
          int expectedValue = cas.get();
          boolean b = cas.compareAndSet(expectedValue, (int)(Math.random() * 101));
          System.out.println(b);
        }
      }).start();
    }

  }

}

class CompareAndSwap{
  private int value;

  //获取内存值
  public synchronized int get(){
    return value;
  }

  //比较
  public synchronized int compareAndSwap(int expectedValue, int newValue){
    int oldValue = value;

    if(oldValue == expectedValue){
      this.value = newValue;
    }

    return oldValue;
  }

  //设置
  public synchronized boolean compareAndSet(int expectedValue, int newValue){
    return expectedValue == compareAndSwap(expectedValue, newValue);
  }
}
```

