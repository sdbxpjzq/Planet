根本原因就是 ==作用域中变量的生命周期导致的==



 下面的代码编译之后, 会生成 4个class文件 -- `Outer.class` `Outer$Inner.class` `Outer$1.class` `Outer$2.class`

所以 内部类和外部类是处于同一个级别的，内部类不会因为定义在方法中就会随着方法的执行完毕就被销毁

这里会产生一个问题:

当外部类的方法结束时，局部变量就会被销毁了，但是内部类对象可能还存在, 导致内部类对象访问了一个不存在的变量。

为了解决这个问题，就将局部变量复制了一份作为内部类的成员变量，这样当局部变量死亡后，内部类仍可以访问它，实际访问的是局部变量的"copy"。



若变量是final时:

- 若是基本类型，其值是不能改变的，就保证了copy与原始的局部变量的值是一样的；
- 若是引用类型，其引用是不能改变的，保证了copy与原始的变量引用的是同一个对象。



```java
// 第一个 Outer.class
public class Outer {
    public static void main(String[] args) {
        Outer outer = new Outer();
        outer.test1();
        outer.test2("165");
    }

    // 第二个 Outer$Inner.class
    public static class Inner {
        public void print() {
        }
    }

    //1. 在内部类的方法使用到方法中定义的局部变量，则该局部变量需要添加 final 修饰符
    public void test1() {
        final int temp = 1;
        // 第三个 class Outer$1
        Inner inner = new Inner() {
            @Override
            public void print() {
                System.out.println(temp);
            }
        };
    }

    //2. 在内部类的方法形参使用到外部传过来的变量，则形参需要添加 final 修饰符
    public void test2(final String s) {
        // 第四个 class Outer$1
        Inner inner = new Inner() {
            @Override
            public void print() {
                System.out.println(s);
            }
        };
    }
}
```



![](https://youpaiyun.zongqilive.cn/image/20210307192622.png)

通过偷偷塞构造函数的方式，传入了局部变量的一个拷贝。

如果允许修改该局部变量的引用，外部修改无法对内部生效，内部的修改也无法对外部生效，一定程度上会引起歧义，索性写死为`final`得了。