## 作用

获取从键盘输入

通过 `Scanner` 类的 `next()` 与 `nextLine()` 方法获取输入的字符串，在读取前我们一般需要 使用` hasNext` 与` hasNextLine` 判断是否还有输入的数据：

## `next()`方式

```java
// System.in 代表从系统输入
Scanner scanner = new Scanner(System.in);
String str = scanner.next(); // 输入: zong qi
System.out.println(str); // 输出: zong
```

## `nextLine`方式

```java
// System.in 代表从系统输入
Scanner scanner = new Scanner(System.in);
String str = scanner.nextLine();// 输入: zong qi
System.out.println(str);// 输出: zong qi
```

## next()与nextLine()区别

next():

- 1、一定要读取到有效字符后才可以结束输入。
- 2、对输入有效字符之前遇到的空白，next()方法会自动将其去掉。
- 3、只有输入有效字符后才将其后面输入的空白作为分隔符或者结束符。
- next()不能得到带有空格的字符串。

nextLine()：

- 1、以Enter为结束符,也就是说nextLine()方法返回的是输入回车之前的所有字符。
- 2、可以获得空白。

注意:

如果要输入int或float类型的数据，在Scanner类中也有支持，但是在输入之前最好先使用 hasNextXxx() 方法进行验证，再使用 nextXxx() 来读取

```java
import java.util.Scanner;  

public class ScannerDemo {  
    public static void main(String[] args) {  
        Scanner scan = new Scanner(System.in);  
		// 从键盘接收数据  
        int i = 0 ;  
        float f = 0.0f ;  
        System.out.print("输入整数：");  
        if(scan.hasNextInt()){                 
			// 判断输入的是否是整数  
            i = scan.nextInt() ;                
			// 接收整数  
            System.out.println("整数数据：" + i) ;  
        }else{                                 
			// 输入错误的信息  
            System.out.println("输入的不是整数！") ;  
        }  
        System.out.print("输入小数：");  
        if(scan.hasNextFloat()){              
			// 判断输入的是否是小数  
            f = scan.nextFloat() ;             
			// 接收小数  
            System.out.println("小数数据：" + f) ;  
        }else{                                
			// 输入错误的信息  
            System.out.println("输入的不是小数！") ;  
        }  
    }  
} 
```





























































