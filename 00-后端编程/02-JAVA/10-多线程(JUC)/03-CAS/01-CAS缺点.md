## 循环时间开销很大

```java
/**CAS中有个do while 方法 ：如果CAS失败，会一直进行尝试，如果CAS长时间一直不成功，会给CPU带来很大的开销*/
public final int getAndAddInt(Object var1, long var2, int var4) {
  int var5;
  // 自旋锁
  do {
    var5 = this.getIntVolatile(var1, var2);
  } while(!this.compareAndSwapInt(var1, var2, var5, var5 + var4));
  return var5;
}

```

## 一次性只能保证一个共享变量的原子性

只能保证一个共享变量的原子性 当对一个共享变量执行操作的时候，我们可以使用循环CAS的方式来保证原子操作，但是对多个共享变量操作时，循环CAS就无法保证操作的原子性，这个时候就可以用锁来保证原子性。


































