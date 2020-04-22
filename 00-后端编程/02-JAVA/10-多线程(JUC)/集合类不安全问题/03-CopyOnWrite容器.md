## 写时复制

CopyOnWrite容器即写时复制的容器. 往一个容器添加元素的时候, 不直接往当前容器`Object[]`添加, 而是先将当前容器`Object[]`进行`Copy`, 复制出一个新的容器`Object[] newElements`, 然后往新的`Object[] newElements`中添加元素, 添加完元素之后, 将圆融起的引用指向新的容器`setArray(newElements)`. 

这样做的好处 是可以对`CopyOnwrite`容器进行并发的读, 而不需要加锁, 因为当前容器不会添加任何元素, 所以`CopyOnWrite`容器也是一种读写分离的思想, 读和写不同的容器.



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

































