```java
public interface Fu {
    public abstract void eat();
}
```

**子类要重写接口中的`所有的`抽象方法, 除非该子类是`抽象类`.**

接口中不能有静态代码块

接口中不能有构造方法

## 成员变量

`interface`中也可以定义成员变量, 但是必须使用`public static final`修饰.

其实就是一个`常量`, 一旦赋值 , 不可修改

```java
public interface Fu {
    public static final  int MY_NUM = 100;
    public abstract void eat();
    public static void run() {
        System.out.println("接口中的静态方法");
    }
}
```





## 不同java版本说明

java7版本-- 接口中可以包含: 

1. 常量
2. 抽象方法

java8版本-- 接口中可以包含: 

1. 常量
2. 抽象方法
3. `默认方法(default)`
4. `静态方法`

```java
public interface Fu {
    public abstract void eat();
  // 接口中的静态方法
    public static void run() {
        System.out.println("接口中的静态方法");
    }
}
```

```java
public class Zi implements Fu {
    @Override
    public void eat() {
        System.out.println("eat");
    }
}
```

```java
public static void main(String[] args) throws ParseException {
        Zi zi = new Zi();
        zi.eat();
        Fu.run(); // 调用interface中的静态方法(不能通过 zi.run() 来调用)
}
```





java9版本-- 接口中可以包含: 

1. 常量
2. 抽象方法
3. 默认方法(default)
4. 静态方法
5. `私有方法`

