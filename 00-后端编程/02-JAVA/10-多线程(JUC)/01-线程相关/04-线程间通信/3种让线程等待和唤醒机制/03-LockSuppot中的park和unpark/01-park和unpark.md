LockSupport调用的Unsafe中的native代码

```java
// permit默认是0，所以一开始调用park()方法，当前线程就会阻塞，直到别的线程将当前线程的permit设置为1时, park方法会被唤醒，
// 然后会将permit再次设置为0并返回。
public static void park() {
  UNSAFE.park(false, 0L);
}

// 调用unpark(thread)方法后，就会将thread线程的许可permit设置成1
// (注意多次调用unpark方法，不会累加，permit值还是1)会自动唤醒thread线程，即之前阻塞中的LockSupport.park()方法会立即返回
public static void unpark(Thread thread) {
  if (thread != null)
    UNSAFE.unpark(thread);
}
```

## 形象理解

线程阻塞需要消耗凭证(permit), 这个凭证最多只有1个

当调用park时:

- 如果有凭证, 则会直接消耗凭证,然后正常退出
- 如果无凭证, 就必须阻塞, 等待凭证可用

当调用unpark时:

- 会增加一个凭证, 但是凭证最多只能有1个,  上限是1,  累加无效

![](https://youpaiyun.zongqilive.cn/image/20201105154026.png)

