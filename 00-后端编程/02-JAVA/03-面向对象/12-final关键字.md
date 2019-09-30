## 修饰一个类

```java
public final class A {
  public void method() {
    xxxx
  }
}
```

一个类如果是`final`的, 那么所有的成员方法都无法进行覆盖重写.

## 修饰一个方法

这个方法是最终方法, 不能背覆盖重写

```java
public class Fu {
  public final void method() {
   xxxxxxx
  }
}
```

## 修饰一个成员变量

成员变量的值不可改变.

由于成员变量具有默认值,  不手动赋值的话, 以后就无法更改,   所以用了`final`之后必须手动赋值, 

`final`的成员变量, 要么使用`直接赋值`,  要么通过`构造方法赋值`

```java
public class Zi {
    private final String nameA = "lisi";
    private final String nameB;

    public Zi(String nameB) {
        this.nameB = nameB;
    }
}

```





## 修饰一个局部变量

这个变量不能修改





## 注意事项

对于`基本类型`来说,  不可变说的是变量中的`数据`不可改变

对于`引用类型`来说, 不可变说的是变量当中的`地址值`不可变

```java
final Student stu = new Student("lisi");

// 下边的写法是错误的.
// final的引用类型变量, 其中的地址不可改变
// stu = new Student("wangwu");

stu.setName("zhaosi");

```

























