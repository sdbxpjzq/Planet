实现Runnable接口的run方法,并把Runnable实例传给Thread类

- 最终是调用target.run()



```java
private Runnable target;
@Override
public void run() {
  if (target != null) {
    target.run();
  }
}
```

