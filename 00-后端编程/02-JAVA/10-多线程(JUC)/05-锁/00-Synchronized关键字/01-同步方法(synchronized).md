同步方法: `synchronized`修饰的方法, 

格式:

```
public synchronized void method() {
	// 逻辑代码
}
```

## 同步锁是谁?

1. 非`static`方法嘛同步锁 就是`this`
2. `static`方法, 使用当前方法所在类的字节码对象(`类名.class`)

```java
public class MyRunnable implements Runnable {
    private int total = 10;
    // 创建一个锁对象
    Object obj = new Object();
    @Override
    public void run() {
        while (true) {
            method();
        }
    }

    private synchronized void method() {
        if (total > 0) {
            System.out.println("正在卖出票: " + total);
            total--;
        }
    }
}
```

## 代码示例

```java
/**
 * 真正的多线程开发，公司中的开发，降低耦合性
 * 线程就是一个单独的资源类，没有任何附属的操作！
 * 1、 属性、方法
 */
public class SaleTicketDemo01 {
    public static void main(String[] args) {
        // 并发：多线程操作同一个资源类, 把资源类丢入线程
        Ticket ticket = new Ticket();
        // @FunctionalInterface 函数式接口，jdk1.8  lambda表达式 (参数)->{ 代码 }
        new Thread(()->{
            for (int i = 1; i < 40 ; i++) {
                ticket.sale();
            }
        },"A").start();

        new Thread(()->{
            for (int i = 1; i < 40 ; i++) {
                ticket.sale();
            }
        },"B").start();

        new Thread(()->{
            for (int i = 1; i < 40 ; i++) {
                ticket.sale();
            }
        },"C").start();
    }
}

// 资源类 OOP
class Ticket {
    // 属性、方法
    private int number = 30;
    // 卖票的方式
    // synchronized 本质: 队列，锁
    public synchronized void sale(){
        if (number>0){
            System.out.println(Thread.currentThread().getName()+"卖出了"+(number--)+"票,剩余："+number);
        }
    }
}
```











