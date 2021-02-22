## 相同

都是final类，都不允许被继承；



## 不同

以下是 String、StringBuffer、StringBuilder 的区别：

  * 可变性：String 为字符串常量是不可变对象，StringBuffer 与 StringBuilder 为字符串变量是可变对象；
  * 性能：
      * String 每次修改相当于生成一个新对象，因此性能最低；
      * StringBuffer 使用 synchronized 来保证线程安全，性能优于 String，但不如 StringBuilder；
  * 线程安全：StringBuilder 为非线程安全类，StringBuffer 为线程安全类。

