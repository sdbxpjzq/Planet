## intern()的使用

`intern()方法`会从字符串常量池中查询当前字符串是否存在,

-  若不存在, 就会将当前字符串放入常量池中,  并且返回此String对象的引用
- 若存在,  则直接返回常量池中这个字符串的对象引用

```java
("a"+"b"+"c").intern() ==  "abc"; // true
```

就是确保字符串在内存中只有一份拷贝, 这样可以节约内存空间, 加快执行速度, 



## 关于intern()的面试难题

需要了解 <a href="./07-new String()到底创建了几个对象(面试).md">07-new String()到底创建了几个对象(面试).md</a>

```java
class A {
public static void main(String[] args) {
        String s = new String("1");
        s.intern(); // 调用此方法之前, 字符串常量池中已经存在了 "1"
        String s2 = "1";
        System.out.println(s == s2); // jdk6: false, jdk7/8: false

        // s3 的地址为: new String("11")
        String s3 = new String("1")+new String("1");
        // 执行完上一行代码以后, 字符串常量池中, 是否存在"11"呢?? 答案: 不存在!!!

        s3.intern(); // 在字符串常量池中生成"11",
        // 上面如何理解: jdk6:创建了一个新的对象"11",也就有新的地址
        // jdk7:此时常量中并没有创建"11", 而是创建一个指向堆空间中 new String("11")

        String s4 = "11";// s4 的地址, 使用的是上一行代码执行时,在常量池中生成的"11"的地址
        System.out.println(s3 == s4);// jdk6: false , jdk7/8: true
    }
}
```
![](https://youpaiyun.zongqilive.cn/image/20200603155655.png)

## 拓展
![](https://youpaiyun.zongqilive.cn/image/20200603163134.png)

## 小结
![](https://youpaiyun.zongqilive.cn/image/20200603163147.png)
### JDK6
![](https://youpaiyun.zongqilive.cn/image/20200603163320.png)

### JDK7/8
![](https://youpaiyun.zongqilive.cn/image/20200603163428.png)

### 拓展
![](https://youpaiyun.zongqilive.cn/image/20200603163536.png)

![](https://youpaiyun.zongqilive.cn/image/20200603165248.png)

## intern()的空间效率
![](https://youpaiyun.zongqilive.cn/image/20200603165703.png)
