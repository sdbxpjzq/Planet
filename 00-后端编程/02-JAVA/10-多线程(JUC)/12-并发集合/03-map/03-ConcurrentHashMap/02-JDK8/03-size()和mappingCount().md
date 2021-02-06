JDK1.8 size 是通过对 baseCount 和 counterCell 进行 CAS 计算，最终通过 baseCount 和 遍历 CounterCell 数组得出 size。

JDK 8 推荐使用mappingCount 方法，因为这个方法的返回值是 long 类型，不会因为 size 方法是 int 类型限制最大值。

```java
public int size() {
  long n = sumCount();
  return ((n < 0L) ? 0 :
          (n > (long)Integer.MAX_VALUE) ? Integer.MAX_VALUE :
          (int)n);
}

public long mappingCount() {
  long n = sumCount();
  return (n < 0L) ? 0L : n; // ignore transient negative values
}
```

