## 写时复制

<img src="https://youpaiyun.zongqilive.cn/image/20200422084420.png" style="zoom: 200%;" />



源码:

```java
public boolean add(E e) {
  final ReentrantLock lock = this.lock;
  lock.lock();
  try {
    Object[] elements = getArray();
    int len = elements.length;
    Object[] newElements = Arrays.copyOf(elements, len + 1);
    newElements[len] = e;
    setArray(newElements);
    return true;
  } finally {
    lock.unlock();
  }
}
```

































