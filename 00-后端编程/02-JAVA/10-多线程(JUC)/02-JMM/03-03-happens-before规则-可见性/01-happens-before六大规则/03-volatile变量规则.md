## volatile 变量规则

对一个 volatile 域的写，happens-before 于任意后续对这个 volatile 域的读



简单的理解：一个线程修改了`volatile`变量，则对另外一个线程读取`volatile`的变量是可见的。



