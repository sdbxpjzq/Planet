## 弱引用

![](https://youpaiyun.zongqilive.cn/image/20200605163856.png)



![](https://youpaiyun.zongqilive.cn/image/20200605165910.png)





- 弱引用需要用`java.lang.ref.WeakReference`类来实现，它比软引用的生存期更短
- 对于弱引用的对象，只要垃圾回收机制一运行，**不管JVM的内存空间是否足够，都会回收该对象占用的内存。**



```java

public static void main(String[] args) {
  Object o1 = new Object();
  WeakReference weakReference = new WeakReference(o1);
  o1 = null;
  System.gc();
  System.out.println(o1); // null
  System.out.println(weakReference.get()); //null
}
```













