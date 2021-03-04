继承Thread类, 重写run方法

- run()整个被重写

```java
private Runnable target;
@Override
public void run() {
  if (target != null) {
    target.run();
  }
}
```

