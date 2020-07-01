

- join合并线程, 待此线程执行完成后, 在执行其他线程, 其他线程阻塞
- 可以想像成插队



```java
public class Test03 implements Runnable {

  @Override
  public void run() {
    for (int i = 0; i < 1000; i++) {
      System.out.println("join..." + i);
    }
  }

  public static void main(String[] args) throws InterruptedException {
    Test03 test03 = new Test03();
    Thread thread = new Thread(test03);
    thread.start();

    for (int i = 0; i < 100; i++) {
      if (i == 50) {
        thread.join();
      }
      System.out.println("main..." + i);
    }
  }
}

```































