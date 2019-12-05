函数式编程思想

## Lambda格式

```
(参数类型 参数名称) -> { 代码语句 }
```

## Lambda的使用前提

1. 使用`Lambda`必须具有接口, **且要求接口中`有且仅有一个抽象方法`**.(有且仅有一个抽象方法的接口, 称为`函数式接口`)

## Lambda省略规则

1. 小括号内参数的类型可以省略
2. 如果小括号内`有且仅有一个参数`, 则可以省略小括号
3. 如果`{ }`内`有且仅有一个语句`, 无论是否有返回值, 都可以省略`{ }`,`return`关键字



代码示例:

`Calculate.java`

```java
public interface Calculate {
  int cal(int a, int b);
}
```

`main.java`

常规写法

```java
public class main {
    public static void main(String[] args) {
        int i;
      // 常规写法
        i = inkCal(10, 20, new Calculate() {
            @Override
            public int cal(int a, int b) {
                return a + b;
            }
        });
        System.out.println(i);
    }

    private static int inkCal(int a, int b, Calculate cal) {
        return cal.cal(a, b);
    }
}
```

Lambda表达式

```java
public class main {
  public static void main(String[] args) {
    int i;
    i = inkCal(10, 20, (a, b) -> a + b);
    System.out.println(i);
  }

  private static int inkCal(int a, int b, Calculate cal) {
    return cal.cal(a, b);
  }
}
```

## 



















































